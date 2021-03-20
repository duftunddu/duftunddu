import sys
import pickle

# Pickling
file = open("sustainability_template", "wb")

# dump information to that file
list_pickle = pickle.dump(sys.argv[1], file)

# close the file
file.close()
