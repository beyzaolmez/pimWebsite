import openai

api_key_path = "txt/api-key.txt"
with open(api_key_path, 'r') as files:
    API_KEY = files.read()
model_id = 'whisper-1'


def transcribe(media_file_path):
    media_file = open(media_file_path, 'rb')  # Open the file in binary mode
    # Rest of your transcription code here...

    response = openai.Audio.transcribe(
        api_key=API_KEY,
        model=model_id,
        file=media_file,
        response_format='text'
    )
    # print(response)
    with open('txt/transcription.txt', 'w', encoding='utf-8') as file:
        file.write(response)

# transcribe("male.wav")
