# To add a new cell, type '# %%'
# To add a new markdown cell, type '# %% [markdown]'
# %%
# from IPython import get_ipython

# %% [markdown]
## Extraction

#%%

import sys

# %%

import numpy as np
import pandas as pd

# import pandas
from scipy import stats

# For import export of model
import pickle

import json

# %%
# Open file to
# file = open("sustainability_template.pickle", "rb")

# Load model from the file
# loaded_pickle = pickle.load(file)

# close the file
# file.close()

# print(loaded_pickle)


# %%

# Local
# datastore = json.loads(loaded_pickle)
# Production
# datastore = json.loads(sys.argv[1])


# %%
# df = pd.DataFrame(data=json.loads(loaded_pickle))
df = pd.DataFrame(data=json.loads(sys.argv[1]))
# df = pandas.DataFrame(data=json.loads(sys.argv[1]))

# %%
df = df.convert_dtypes()


# %%
def get_correlation(df):
    return df.corrwith(df["longevity"], method="kendall")[1:]


# %%
corr = get_correlation(df)
corr.dropna(inplace=True)


# %%
def get_weighted_average(array, weights):
    return round(np.average(array, weights=weights), 2)


# %%
average = 0
if corr.isnull().all():
    # If all values are null
    print(-1)
elif (corr != 0).all():
    # If all values are not zero
    print(get_weighted_average(corr, abs(corr)))
# %%
