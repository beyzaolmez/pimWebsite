import subprocess
from http.server import BaseHTTPRequestHandler, HTTPServer

import openai

from backend.transcribe import transcribe
from operations import handle_button_click

openai.api_key = "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"


class TranscribeHandler(BaseHTTPRequestHandler):
    def do_POST(self):
        content_length = int(self.headers['Content-Length'])
        button_state = self.headers['Button-State']
        audio_data = self.rfile.read(content_length)

        with open("audio_data.wav", "wb") as file:
            file.write(audio_data)

        transcribe("audio_data.wav")

        # Handle the button state
        handle_button_state(button_state)

        self.send_response(200)
        self.end_headers()

    def send_file_to_raspberry(self, file_path):
        try:
            with open(file_path, 'rb') as file:
                self.send_response(200)
                self.send_header('Content-type', 'audio/wav')
                self.send_header('Content-Disposition', 'attachment; filename="output.wav"')
                self.end_headers()
                self.wfile.write(file.read())
        except Exception as e:
            print(f"An exception occurred while sending the file: {str(e)}")


def handle_button_state(button_state):
    # Handle the button state here
    handle_button_click(button_state)
    print(f"Received button state: {button_state}")


def run_server(server_class=HTTPServer, handler_class=TranscribeHandler, port=8000):
    server_address = ('', port)
    httpd = server_class(server_address, handler_class)
    print(f"Starting server on port {port}...")
    try:
        httpd.serve_forever()
    except KeyboardInterrupt:
        pass


if __name__ == '__main__':
    subprocess.Popen(['python', 'operations.py'])
    run_server()
