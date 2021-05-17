import sys
import pickle

with open("longevity_direct_template.pickle", "wb") as f:
    pickle.dump([sys.argv[1]], f)
