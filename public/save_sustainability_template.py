import sys
from unidecode import unidecode

print(unidecode(sys.argv[1]))

# Pickling
file = open("sustainability", "wb")

# dump information to that file
list_pickle = pickle.dump(sys.argv[1], file)

# close the file
file.close()
