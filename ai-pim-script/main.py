from flask import Flask, send_file, request
import openai

from backend_script.transcribe import transcribe
from backend_script.operations import handle_button_click

api_key_path = "txt/api-key.txt"
with open(api_key_path, 'r') as files:
    openai.api_key = files.read()

app = Flask(__name__)


@app.route('/transcribe', methods=['POST'])
def transcribe_endpoint():
    button_state = request.headers['Button-State']
    audio_data = request.get_data()

    with open("audio/processing/audio_data.wav", "wb") as file:
        file.write(audio_data)

    transcribe("audio/processing/audio_data.wav")

    # Handle the button state
    handle_button_state(button_state)

    # Send the audio file as the response
    return send_file("audio/output/output.wav", mimetype="audio/wav")


def handle_button_state(button_state):
    # Handle the button state here
    handle_button_click(button_state)
    print(f"Received button state: {button_state}")


if __name__ == '__main__':
    app.run()
