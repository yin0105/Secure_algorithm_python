from itertools import cycle
import base64


secret_data = "20201116"
key = 'awesomepassword'
affine_multi = 23
affine_add = 11

def xor_crypt_string(data, key = 'awesomepassword', encode = False):
    from itertools import cycle
    import base64
    
    if not encode:
        data = base64.decodebytes(bytes(data, 'utf-8')).decode("utf-8")
    
    xored = ''.join(chr(ord(x) ^ ord(y)) for (x,y) in zip(data, cycle(key)))

    if encode:
        return base64.encodebytes(bytes(xored, 'utf-8')).decode("utf-8")
    
    return xored


def reverse(data):
    return ''.join(data[i] for i in range(len(data)-1, -1, -1))


def add_checksum(data):
    for i in range(2):
        sum = 0
        for j in range(4):
            sum += int(data[i*4+j])
        data += str(sum)
    return data


def xor_crypt_string(data, encode = False): 
    if not encode:
        data = base64.decodebytes(bytes(data, 'utf-8')).decode("utf-8")
    
    xored = ''.join(chr(ord(x) ^ ord(y)) for (x,y) in zip(data, cycle(key)))

    if encode:
        return base64.encodebytes(bytes(xored, 'utf-8')).decode("utf-8")
    return xored


def affine(data, encode = False):
    # for b in bytes(data, 'utf-8'):
        # print(chr((b * affine_multi + affine_add) % 128))
    # return ""
    if encode:
        return "".join(chr(((b - 33) * affine_multi + affine_add) % 94 + 33) for b in bytes(data, 'utf-8'))
    else:
        result = ""
        for b in bytes(data, 'utf-8'):
            d = b - 33 - affine_add
            while d % affine_multi != 0:
                d += 94
            # print(str(d) + "  " + str(affine_multi))
            result += chr(int(d / affine_multi) + 33)
        return result


def encode(data):
    data = reverse(data)
    data = add_checksum(data)
    print(data)
    data = xor_crypt_string(data, True)
    print(data)
    data = affine(data[:-1], True)
    print(data)
    return data


def decode(data):
    data = affine(data)
    print(data)
    data = xor_crypt_string(data, False)
    print(data)


cipher_text = encode(secret_data)
decode(cipher_text)