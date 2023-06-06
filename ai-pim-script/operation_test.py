import os
from unittest.mock import patch
from operations import handle_button_click

def test_handle_button_click_translate():
    output_file = "txt/output.txt"

    with patch("operations.text_to_speech"), patch("builtins.open", create=True) as mock_open:
        handle_button_click("translate")

        assert os.path.exists(output_file), f"Output file does not exist: {output_file}"
        assert mock_open.call_args[0][0] == output_file, f"Unexpected file path: {mock_open.call_args[0][0]}"

        print(f"Output file: {output_file}")
        print(f"Mock open call args: {mock_open.call_args}")

def test_handle_button_click_en_nl_conversation():
    output_file = "txt/output.txt"

    with patch("operations.text_to_speech"), patch("builtins.open", create=True) as mock_open:
        handle_button_click("en_nl_conversation")

        assert os.path.exists(output_file), f"Output file does not exist: {output_file}"
        assert mock_open.call_args[0][0] == output_file, f"Unexpected file path: {mock_open.call_args[0][0]}"

        print(f"Output file: {output_file}")
        print(f"Mock open call args: {mock_open.call_args}")

def test_handle_button_click_en_en_conversation():
    output_file = "txt/output.txt"

    with patch("operations.text_to_speech"), patch("builtins.open", create=True) as mock_open:
        handle_button_click("en_en_conversation")

        assert os.path.exists(output_file), f"Output file does not exist: {output_file}"
        assert mock_open.call_args[0][0] == output_file, f"Unexpected file path: {mock_open.call_args[0][0]}"

        print(f"Output file: {output_file}")
        print(f"Mock open call args: {mock_open.call_args}")
