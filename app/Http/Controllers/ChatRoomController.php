<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ChatRoomController extends Controller
{
    public function index(Request $request): View
    {
        return view('pages.chat-room', [
            'isAdmin' => Gate::allows('admin'),
            'adminName' => $request->user()?->name,
        ]);
    }

    public function messages(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'after' => ['nullable', 'integer', 'min:0'],
        ]);

        $limit = config('portfolio.chat.history');

        $messages = isset($validated['after'])
            ? ChatMessage::where('id', '>', $validated['after'])->orderBy('id')->limit($limit)->get()
            : ChatMessage::latest('id')->limit($limit)->get()->reverse()->values();

        return response()->json([
            'messages' => $messages->map->toPublicArray(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $isAdmin = Gate::allows('admin');

        $validated = $request->validate([
            'name' => [$isAdmin ? 'nullable' : 'required', 'string', 'max:40'],
            'message' => ['required', 'string', 'max:500'],
            'website' => ['nullable', 'string'], // honeypot, harus kosong
        ]);

        // Bot biasanya ngisi semua field. Pura-pura sukses biar dia gak nyoba lagi.
        if (filled($validated['website'] ?? null)) {
            return response()->json(['message' => null], 201);
        }

        $name = $isAdmin ? $request->user()->name : $this->clean($validated['name']);
        $text = $this->clean($validated['message']);

        if ($name === '' || $text === '') {
            throw ValidationException::withMessages(['message' => 'Name and message cannot be empty.']);
        }

        // Link dari pengunjung diblok, soalnya hampir selalu spam
        if (! $isAdmin && preg_match('~(https?://|www\.)~i', $name.' '.$text)) {
            throw ValidationException::withMessages(['message' => 'Links are not allowed in the chat.']);
        }

        $ipHash = hash('sha256', $request->ip().'|'.config('app.key'));

        $duplicate = ChatMessage::where('ip_hash', $ipHash)
            ->where('message', $text)
            ->where('created_at', '>=', now()->subMinutes(10))
            ->exists();

        if ($duplicate) {
            throw ValidationException::withMessages(['message' => 'You already sent that message.']);
        }

        $message = new ChatMessage(['name' => $name, 'message' => $text]);
        $message->is_author = $isAdmin;
        $message->ip_hash = $ipHash;
        $message->save();

        return response()->json(['message' => $message->toPublicArray()], 201);
    }

    public function destroy(ChatMessage $message): JsonResponse
    {
        $message->delete();

        return response()->json(['deleted' => $message->id]);
    }

    private function clean(string $value): string
    {
        // Buang tag HTML sama karakter kontrol, rapihin spasi berlebih
        $value = strip_tags($value);
        $value = preg_replace('/[^\P{Cc}\n]/u', '', $value) ?? '';
        $value = preg_replace("/\n{3,}/", "\n\n", $value) ?? '';

        return trim($value);
    }
}
