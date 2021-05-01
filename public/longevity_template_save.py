import sys
import pickle

with open("longevity_template.pickle", "wb") as f:
    pickle.dump([sys.argv[1], sys.argv[2], sys.argv[3]], f)
