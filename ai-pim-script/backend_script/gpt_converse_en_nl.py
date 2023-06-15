import openai

api_key_path = "txt/api-key.txt"
with open(api_key_path, 'r') as files:
    openai.api_key = files.read()


def get_api_response(prompt: str) -> str | None:
    text: str | None = None

    try:
        response: dict = openai.Completion.create(
            model='text-davinci-003',
            prompt=prompt,
            temperature=0.9,
            max_tokens=150,
            top_p=1,
            frequency_penalty=0,
            presence_penalty=0.6,
            stop=[' Human:', ' AI:']
        )

        choices: dict = response.get('choices')[0]
        text = choices.get('text')

    except Exception as e:
        print('ERROR:', e)

    return text


def update_list(message: str, pl: list[str]):
    pl.append(message)


def create_prompt(message: str, pl: list[str]) -> str:
    p_message: str = f'\nHuman: {message}'
    update_list(p_message, pl)
    prompt: str = ''.join(pl)
    return prompt


def get_bot_response(message: str, pl: list[str]) -> str:
    prompt: str = create_prompt(message, pl)
    bot_response: str = get_api_response(prompt)

    if bot_response:
        update_list(bot_response, pl)
        pos: int = bot_response.find('\nAI: ')
        bot_response = bot_response[pos + 5:]
    else:
        bot_response = 'Something went wrong...'

    return bot_response


def en_to_nl(file_path: str):
    prompt_list: list[str] = ['You and I will have a conversation.',
                              '\nYou: How are you doing?',
                              '\nAI: Het gaat goed met mij. Bedankt voor het vragen']

    with open(file_path, 'r') as file:
        content = file.read()

    user_input: str = content
    response: str = get_bot_response(user_input, prompt_list)
    return response


def en_to_en(file_path: str):
    prompt_list: list[str] = ['You and I will have a conversation.',
                              '\nYou: How are you doing?',
                              '\nAI: I am doing great and you?']

    with open(file_path, 'r') as file:
        content = file.read()

    user_input: str = content
    response: str = get_bot_response(user_input, prompt_list)
    return response


# if __name__ == '__main__':
#     main()
