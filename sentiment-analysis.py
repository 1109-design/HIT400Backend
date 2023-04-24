import sys
import openai

def sentiment(text):
    openai.api_key = "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"

    response = openai.Completion.create(
        model="text-davinci-003",
        prompt="Classify the sentiment in this tweet and show percentage of sentiment: " + text,
        temperature=0,
        max_tokens=60,
        top_p=1.0,
        frequency_penalty=0.0,
        presence_penalty=0.0
    )
    response_data = dict(response)
    return response_data['choices'][0]['text']

if __name__ == '__main__':
    text = sys.argv[1]
    result = sentiment(text)
    print(result)
