// Helper fetch JSON yang otomatis bawa token CSRF Laravel
const csrfToken = () => document.querySelector('meta[name="csrf-token"]')?.content ?? '';

export class HttpError extends Error {
    constructor(status, body) {
        super(body?.message || `Request failed (${status})`);
        this.status = status;
        this.body = body;
    }
}

export async function requestJson(url, { method = 'GET', body } = {}) {
    const response = await fetch(url, {
        method,
        headers: {
            Accept: 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            ...(body ? { 'Content-Type': 'application/json' } : {}),
            ...(method !== 'GET' ? { 'X-CSRF-TOKEN': csrfToken() } : {}),
        },
        body: body ? JSON.stringify(body) : undefined,
        credentials: 'same-origin',
    });

    const data = await response.json().catch(() => null);

    if (!response.ok) {
        throw new HttpError(response.status, data);
    }

    return data;
}

// Ambil pesan error yang enak dibaca dari respons Laravel (422/429/503)
export function errorMessage(error, fallback = 'Something went wrong. Please try again.') {
    const errors = error?.body?.errors;

    if (errors) {
        const first = Object.values(errors)[0];
        return Array.isArray(first) ? first[0] : String(first);
    }

    if (error?.status === 419) {
        return 'Your session expired. Please refresh the page.';
    }

    return error?.body?.message || fallback;
}
