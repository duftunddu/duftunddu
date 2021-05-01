import sys
import pickle

with open("suitability_template.pickle", "wb") as f:
    pickle.dump(sys.argv[1], f)
