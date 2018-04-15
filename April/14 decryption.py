# take a code, and encrypt it
# q => w and so on, shifted one right
import string

def caesar(plaintext, shift):
    alphabet = string.ascii_lowercase
    shifted_alphabet = alphabet[shift:] + alphabet[:shift]
    table1 = str.maketrans(alphabet, shifted_alphabet)
    print(plaintext.translate(table1))

def qwerty(plaintext,shift):
    keyboard = 'qwertyuiopasdfghjklzxcvbnm'
    shifted_keyboard = keyboard[shift:] + keyboard[:shift]
    table2 = str.maketrans(keyboard, shifted_keyboard)
    print(plaintext.translate(table2))
# learn to import
def decaesar(code, x):
    shift = -x
    alphabet = string.ascii_lowercase
    shifted_alphabet = alphabet[shift:] + alphabet[:shift]
    table1 = str.maketrans(alphabet, shifted_alphabet)
    print(code.translate(table1))

def deqwerty(code, x):
    shift = -x
    keyboard = 'qwertyuiopasdfghjklzxcvbnm'
    shifted_keyboard = keyboard[shift:] + keyboard[:shift]
    table2 = str.maketrans(keyboard, shifted_keyboard)
    print(code.translate(table2))

caesar('potato',12)
qwerty('encrypted', 2)

decaesar('bafmfa', 12)
deqwerty('tqbyisutg', 2)
