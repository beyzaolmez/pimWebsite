import unittest
from unittest.mock import patch
from backend_script import translate_text


class TranslateTextTest(unittest.TestCase):
    @patch('backend_script.requests.post')
    def test_translate_text_success(self, mock_post):
        mock_post.return_value.status_code = 200
        mock_post.return_value.json.return_value = {
            "choices": [
                {
                    "text": "Translated text"
                }
            ]
        }

        result = translate_text("path/to/file.txt")
        self.assertEqual(result, "Translated text")

    @patch('backend_script.requests.post')
    def test_translate_text_failure(self, mock_post):
        mock_post.return_value.status_code = 400

        result = translate_text("path/to/file.txt")
        self.assertIsNone(result)


if __name__ == '__main__':
    unittest.main()
