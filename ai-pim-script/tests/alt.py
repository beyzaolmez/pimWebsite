from flask import Flask, send_file, request
import openai

from backend.transcribe import transcribe
from operations import handle_button_click

openai.api_key = "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"

app = Flask(__name__)


@app.route('/transcribe', methods=['POST'])
def transcribe_endpoint():
    button_state = request.headers['Button-State']
    audio_data = request.get_data()

    with open("audio_data.wav", "wb") as file:
        file.write(audio_data)

    transcribe("audio_data.wav")

    # Handle the button state
    handle_button_state(button_state)

    # Send the audio file as the response
    return send_file("output.wav", mimetype="audio/wav")

def handle_button_state(button_state):
    # Handle the button state here
    handle_button_click(button_state)
    print(f"Received button state: {button_state}")

if __name__ == '__main__':
    app.run()
