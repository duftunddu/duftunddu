import sys
import json
import numpy
import pandas as pd

# import os
# import unidecode
print(len(sys.argv))
print("\n\n")
print(sys.argv[1])
print(sys.argv[2])
print(sys.argv[3])

with open("objs.pickle", "wb") as f:  # Python 3: open(..., 'wb')
    pickle.dump([obj0, obj1, obj2], f)

# print(sys.argv[1])
# df = pd.DataFrame(data=json.loads(sys.argv[1]))
# df = pd.read_json(sys.argv[1])
# df
# print(len(sys.argv[1]))
# print(json.loads(sys.argv[1]))
# print(json.loads(sys.argv[2]))
# print(json.loads(sys.argv[3]))

# from numpy import numpy
# import numpy
# import pandas

# import random

# import numpy.random.RandomState(0)

# from numpy import random.RandomState()

# np.random.RandomState(2021)

# print(os.environ)
# os.environ["DEBUSSY"] = "1"
# for k, v in os.environ.items():
#     print(f"{k}={v}")

# 2146893795
# del os.environ["PYTHONHASHSEED"]
# random.seed(a=None, version=2)
# os.environ.pop("PYTHONHASHSEED")

# os.unsetenv("PYTHONHASHSEED")

# os.environ["PYTHONHASHSEED"] = "3"

# hashseed = os.getenv("PYTHONHASHSEED")
# if not hashseed:
# os.environ["PYTHONHASHSEED"] = "0"
# os.execv(sys.executable, [sys.executable] + sys.argv)


# import numpy

# print("asdasdasd")
