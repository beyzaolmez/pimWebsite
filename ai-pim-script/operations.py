from gtts import gTTS
from backend_script.gpt_translate import translate_text
from backend_script.gpt_converse_en_nl import en_to_nl, en_to_en

VALID_BUTTON_STATES = ["translate", "en_nl_conversation", "en_en_conversation"]
current_button_state = None


def handle_button_click(button_type):
    global current_button_state

    if button_type in VALID_BUTTON_STATES:
        if current_button_state == button_type:
            # Button state is already active, ignore the button press
            pass
        else:
            current_button_state = button_type
    else:
        print("Error: Invalid button type.")
        return

    if button_type == "translate":
        translation = translate_text("txt/transcription.txt")
        with open("txt/output.txt", "w", encoding="utf-8") as file:
            file.write(translation)
        text_to_speech(translation, 'en')
    elif button_type == "en_nl_conversation":
        en_nl_conversation = en_to_nl("txt/transcription.txt")
        with open("txt/output.txt", "w", encoding="utf-8") as file:
            file.write(en_nl_conversation)
        text_to_speech(en_nl_conversation, 'nl')
    elif button_type == "en_en_conversation":
        en_en_conversation = en_to_en("txt/transcription.txt")
        with open("txt/output.txt", "w", encoding="utf-8") as file:
            file.write(en_en_conversation)
        text_to_speech(en_en_conversation, 'en')


def text_to_speech(text, language):
    tts = gTTS(text=text, lang=language)
    tts.save("output.wav")


# def main():
#     # Test the button states
#     handle_button_click("en_en_conversation")  # Button state: translate
#     # handle_button_click("en_nl_conversation")  # Button state: en_nl_conversation
#     # handle_button_click("en_nl_conversation")  # Ignored (button state 'en_nl_conversation' is already active)
#     # handle_button_click("translate")  # Button state: translate
#
#
# if __name__ == "__main__":
#     main()
