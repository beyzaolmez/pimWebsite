import requests

url = 'http://localhost:5000/transcribe'
button_state = 'translate'
audio_file_path = 'audio/input/harvard.wav'

# Read the audio file data
with open(audio_file_path, 'rb') as audio_file:
    audio_data = audio_file.read()

# Set the headers
headers = {'Button-State': button_state}

# Make the POST request
response = requests.post(url, headers=headers, data=audio_data)

# Check the response status
if response.status_code == 200:
    with open('audio/output/output.wav', 'wb') as file:
        file.write(response.content)
    print('Request succeeded. Audio file saved as output.wav')
else:
    print('Request failed. Status code:', response.status_code)
