import requests

api_key_path = "txt/api-key.txt"
api_endpoint = "https://api.openai.com/v1/completions"
with open(api_key_path, 'r') as files:
    api_key = files.read()


def translate_text(file_path: str):
    with open(file_path, 'r') as file:
        content = file.read()

    request_headers = {
        "Content-Type": "application/json",
        "Authorization": f"Bearer {api_key}"
    }

    request_data = {
        "model": "text-davinci-003",
        "prompt": f"Translate {content} to dutch",
        "max_tokens": 3890,
        "temperature": 0.5,
    }

    response = requests.post(api_endpoint, headers=request_headers, json=request_data)

    if response.status_code == 200:
        translated = response.json()["choices"][0]["text"]
        return translated.strip()
    else:
        print(f"Request failed with status: {str(response.status_code)}")


# translation = translate_text('../transcription.txt')
# print(translation)
