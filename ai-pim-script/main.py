from flask import Flask, send_file, request, redirect, jsonify
import openai

from backend_script.transcribe import transcribe
from operations import handle_button_click
from flask_cors import CORS

api_key_path = "txt/api-key.txt"
with open(api_key_path, 'r') as files:
    openai.api_key = files.read()

app = Flask(__name__)
CORS(app)


@app.route('/transcribe', methods=['POST'])
def transcribe_endpoint():
    button_state = request.headers['Button-State']
    audio_data = request.get_data()

    with open("audio/processing/audio_data.wav", "wb")   as file:
        file.write(audio_data)

    transcribe("audio/processing/audio_data.wav")

    # Handle the button state
    handle_button_state(button_state)

    # Send the audio file as the response
    return send_file("audio/output/output.wav", mimetype="audio/wav")


@app.route('/conn_pim', methods=['POST'])
def connect_to_pim_endpoint():
    text = request.form['english']
    if text == '':
        text = 'What would you like to translate?'

    file_path = 'txt/transcription.txt'
    with open(file_path, 'w') as file:
        file.write(text)

    button_state = 'translate'

    handle_button_state(button_state)

    return redirect('http://localhost/pimWebsite/translate.php')


@app.route('/web_translate', methods=['POST'])
def web_translate_endpoint():
    button_state = 'translate'

    text = request.form['english']

    if text == '':
        text = 'What would you like to translate?'

    # Write the user_text to a file
    file_path = 'txt/transcription.txt'
    with open(file_path, 'w') as file:
        file.write(text)

    # Handle the button state (including translation)
    handle_button_click(button_state)

    # Read the translated text from the output file
    output_file_path = 'txt/output.txt'
    with open(output_file_path, 'r') as file:
        translated_text = file.read()

    response = {
        'translated_text': translated_text
    }

    return jsonify(response)


def handle_button_state(button_state):
    # Handle the button state here
    handle_button_click(button_state)
    print(f"Received button state: {button_state}")


if __name__ == '__main__':
    app.run()
