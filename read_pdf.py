import sys
from pypdf import PdfReader

def main():
    if len(sys.argv) < 2:
        print("Usage: python read_pdf.py <pdf-file>")
        return

    pdf_path = sys.argv[1]
    
    try:
        reader = PdfReader(pdf_path)
        text = ""
        for page in reader.pages:
            text += page.extract_text() + "\n--- PAGE BREAK ---\n"
        print(text)
    except Exception as e:
        print(f"Error: {e}")

if __name__ == "__main__":
    main()
