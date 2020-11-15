import des

obj = des.new('abcdefgh', des.ECB)
plain = "Guido van Rossum is a space alien."
print(str(len(plain)))
