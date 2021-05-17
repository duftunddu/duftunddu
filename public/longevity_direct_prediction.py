# To add a new cell, type '# %%'
# To add a new markdown cell, type '# %% [markdown]'
# %%
# from IPython import get_ipython

# %% [markdown]
# ## Extraction

# %%
# get_ipython().run_line_magic("matplotlib", "inline")

# %% [markdown]
# # Write column names

# %%
# def listToString(s):

#     # initialize an empty string
#     str1 = "\n"

#     # return string
#     return str1.join(s)


# %% [markdown]
# # Libraries Import

# %%
import sys
import numpy as np
import pandas as pd
from datetime import datetime

# For import export of model
import pickle
import json
from sklearn.linear_model import LinearRegression

# %% [markdown]
# ## For Review

# %%

fragrance = sys.argv[1]
profile = sys.argv[2]
weather = sys.argv[3]
reviews = sys.argv[4]

# with open("longevity_template.pickle", "rb") as f:
#     fragrance, profile, weather = pickle.load(f)


# %%
# fragrance_df = pd.read_json(fragrance)

fragrance_df = pd.DataFrame(data=eval(fragrance), index=[0])
profile_df = pd.DataFrame(data=eval(profile), index=[0])
weather_df = pd.DataFrame(data=eval(weather), index=[0])


# %% [markdown]
# #### Fixing Weather Keys

# %%
def fix_weather_keys(df):
    old_weather_columns = df.columns
    new_weather_columns = []
    for i in range(len(old_weather_columns) - 2):
        new_weather_columns.append(old_weather_columns[i] + "_avg")
    new_weather_columns.extend(old_weather_columns[-2:])
    df.columns = new_weather_columns
    return df


# %%
weather_df = fix_weather_keys(weather_df)
# weather_df


# %%
single_df = pd.concat([fragrance_df, profile_df, weather_df], axis=1)


# %% [markdown]
# ## Cleaning

# %%
single_df = single_df[single_df.columns.difference(["weather_desc"], sort=False)]


# %%
single_df["number_of_sprays"] = 7
single_df["indoor_time_percentage"] = 75
single_df["apply_time"] = datetime.now().strftime("%Y-%m-%d 12:00:00")


# %%
columns_to_drop = [
    "fragrance",
    "fragrance_gender",
    "fragrance_type",
    "brand",
    "brand_tier",
    "uv_index_avg",
    "visibility_avg",
    "atm_pressure_avg",
    "clouds_avg",
    "temp_feels_like_avg",
    "wind_speed_avg",
    "rain_avg",
    "snow_avg",
]

single_df.drop(columns_to_drop, axis=1, inplace=True)


# %% [markdown]
# ## Review Data

# %%
# with open("longevity_direct_template.pickle", "rb") as f:
#     reviews = pickle.load(f)


# %%
# reviews_df = pd.DataFrame(json.loads(reviews[0]))
reviews_df = pd.DataFrame(json.loads(reviews))


# %%
reviews_df.drop(
    [
        "uv_index_avg",
        "visibility_avg",
        "atm_pressure_avg",
        "clouds_avg",
        "temp_feels_like_avg",
        "wind_speed_avg",
        "rain_avg",
        "snow_avg",
        "projection",
        "sillage",
        "climate",
        "like",
    ],
    axis=1,
    inplace=True,
)


# %% [markdown]
# ## Combining dfs

# %%
df = pd.concat([reviews_df, single_df])
# df

# %% [markdown]
# ## Operations on full df

# %%

# Datetime
df["dob"] = df["dob"].astype("datetime64[ns]")
df["apply_time"] = df["apply_time"].astype("datetime64[ns]")


# %%
# Calcualting Age

now = pd.to_datetime("now")
df["age"] = (now - df["dob"]).dt.total_seconds() / (60 * 60 * 24 * 365.25)
df.drop(["dob"], axis=1, inplace=True)


# %%
# Sorting out Dates

# Apply Time
df["apply_time_month"] = df["apply_time"].dt.month
df["apply_time_day"] = df["apply_time"].dt.day
df["apply_time_hour"] = df["apply_time"].dt.hour

# Type Cast
df["age"] = df["age"].astype("float")

# Drop Apply Time & Wear Off Time
df.drop(["apply_time"], axis=1, inplace=True)


# %%
categorical_columns = df.select_dtypes(include=["object"]).columns.values
df = df.convert_dtypes()


# %%
df = pd.get_dummies(
    df, columns=categorical_columns, prefix=categorical_columns, prefix_sep="_"
)


# %%
Y = df["longevity"]
X = df.drop("longevity", axis=1)


# %%
# Remove constant columns
X = X.loc[:, (X != X.iloc[0]).any()]


# %%
# Take the last row for prediction
X_bar = X.tail(1)

# Removing fom dataset
X = X.iloc[:-1]
Y = Y.iloc[:-1]


# %%
model = LinearRegression().fit(X, Y)


# %%
print(model.predict(X_bar)[0])

# %% [markdown]
# # END

