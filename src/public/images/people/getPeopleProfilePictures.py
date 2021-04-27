import requests

for i in range(350):
    res = requests.get('https://thispersondoesnotexist.com/image', stream=True)

    with open(str(i+1)+".jpeg", 'wb') as f:
        for chunk in res:
            f.write(chunk)
        print(str(i+1) + " done")
