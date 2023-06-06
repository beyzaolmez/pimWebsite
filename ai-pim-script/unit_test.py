import pytest
from unittest import mock
from backend_script.gpt_translate import translate_text


@pytest.fixture
def mocked_requests_post():
    with mock.patch('backend_script.gpt_translate.requests.post') as mock_post:
        yield mock_post


def test_translate_text_success(mocked_requests_post):
    file_path = "txt/transcription.txt"
    expected_translation = "Wat wil je vandaag?"

    mock_response = mock.Mock()
    mock_response.status_code = 200
    mock_response.json.return_value = {
        "choices": [
            {"text": expected_translation}
        ]
    }
    mocked_requests_post.return_value = mock_response

    translation = translate_text(file_path)

    mocked_requests_post.assert_called_once()
    assert translation == expected_translation


def test_translate_text_failure(mocked_requests_post):
    mock_response = mock.Mock()
    mock_response.status_code = 500
    mocked_requests_post.return_value = mock_response

    file_path = "txt/transcription.txt"
    translation = translate_text(file_path)

    mocked_requests_post.assert_called_once()
    assert translation is None
