import openai
import json
import sys

openai.api_key = "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"

def generate_answer(search_item):
    prompt = f"What {search_item}?"

    response = openai.Completion.create(
        engine="davinci",
        prompt=prompt,
        max_tokens=1024,
        n=1,
        stop=None,
        temperature=0.7,
    )

    answer = response.choices[0].text.strip()
    return answer

if __name__ == "__main__":
    search_item = sys.argv[1]
    answer = generate_answer(search_item)
    print(json.dumps(answer))
