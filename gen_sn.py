from itertools import cycle
import base64, re, sys


# secret_data = "20201116"
# key = 'awesomepassword'
if len(sys.argv) < 4: sys.exit()
secret_data = str(sys.argv[1])
key = str(sys.argv[2])
convert_mode = str(sys.argv[3])
if convert_mode not in ["encode", "decode"]: sys.exit()
affine_multi = 11
affine_add = 23


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
            sum += int(data[i * 4 + j])
        data += str(sum % 10)
    return data


def check_checksum(data):
    if len(re.findall("^[0-9]{10}$", data)) != 1:
        return False
    for i in range(2):
        sum = 0
        for j in range(4):
            sum += int(data[i * 4 + j])
        if sum % 10 != int(data[8 + i]): return False
    
    return True


def xor_crypt_string(data, encode = False): 
    if not encode:
        data = base64.decodebytes(bytes(data, 'utf-8')).decode("utf-8")
    
    xored = ''.join(chr(ord(x) ^ ord(y)) for (x,y) in zip(data, cycle(key)))
    
    if encode:
        return base64.encodebytes(bytes(xored, 'utf-8')).decode("utf-8")
    
    return xored


def affine(data, encode = False):
    if encode:
        return "".join(chr(((b - 35) * affine_multi + affine_add) % 92 + 35) for b in bytes(data, 'utf-8'))
    else:
        result = ""
        for b in bytes(data, 'utf-8'):
            d = b - 35 - affine_add
            while d % affine_multi != 0:
                d += 92
            result += chr(int(d / affine_multi) + 35)
        return result


def encode(data):
    data = reverse(data)
    data = add_checksum(data)
    data = xor_crypt_string(data, True)
    data = affine(data[:-1], True)
    return data


def decode(data):
    try:
        data = affine(data)
        data = xor_crypt_string(data, False)
        if not check_checksum(data): return "Invalid Secure Code"
        data = reverse(data[:8])
        return data[:4] + "-" + data[4:6] + "-" + data[6:8]
    except:
        return "Invalid Secure Code"

if convert_mode == "encode":
    print(encode(secret_data))
elif convert_mode =="decode":
    print(decode(secret_data))