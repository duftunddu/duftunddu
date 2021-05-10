# To add a new cell, type '# %%'
# To add a new markdown cell, type '# %% [markdown]'
# %% [markdown]
# ## Extraction


# %% [markdown]
# # Libraries Import

# %%
import sys
import numpy as np
import pandas as pd
from datetime import datetime

# For import export of model
import pickle

# from sklearn.tree import DecisionTreeClassifier
from sklearn.ensemble import RandomForestClassifier


# %%
# sys.argv[1]

# with open("longevity_template.pickle", "rb") as f:
#     fragrance, profile, weather = pickle.load(f)

fragrance = sys.argv[1]
profile = sys.argv[2]
weather = sys.argv[3]


# %%
# fragrance_df = pd.read_json(fragrance)

fragrance_df = pd.DataFrame(data=eval(fragrance), index=[0])
profile_df = pd.DataFrame(data=eval(profile), index=[0])
weather_df = pd.DataFrame(data=eval(weather), index=[0])


# %%
# fragrance_df
# profile_df
# weather_df

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
df = pd.concat([fragrance_df, profile_df, weather_df], axis=1)


# %% [markdown]
# ## Cleaning

# %%
# df = df[df.columns.difference(['fba_country_name', 'fba_time_zone', 'suitability', 'sustainability', 'sillage', 'like', 'users_id', 'users_check', 'fba_location_country', 'fba_location_zone'], sort=False)]
df = df[df.columns.difference(["weather_desc"], sort=False)]


# %%
# Missing Values
df["rain_avg"].fillna(int(0), inplace=True)
df["snow_avg"].fillna(int(0), inplace=True)


# %%
df["number_of_sprays"] = 7
df["apply_time"] = datetime.now().strftime("%Y-%m-%d 12:00:00")


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
df["apply_time_year"] = df["apply_time"].dt.year
df["apply_time_month"] = df["apply_time"].dt.month
df["apply_time_day"] = df["apply_time"].dt.day
df["apply_time_hour"] = df["apply_time"].dt.hour
df["apply_time_minute"] = df["apply_time"].dt.minute
df["apply_time_weekday_name"] = df["apply_time"].dt.day_name()

# Type Cast
df["age"] = df["age"].astype("float")

# Drop Apply Time & Wear Off Time
df.drop(["apply_time"], axis=1, inplace=True)


# %%
categorical_columns = df.select_dtypes(include=["object"]).columns.values
df = df.convert_dtypes()


# return
# %%
def resolve_categorical_variables(df, column_names_arr):

    with open("longevity_dummies.pickle", "rb") as f:
        cat_df = pickle.load(f)

    # Adding the rest
    for column_name in column_names_arr:

        new_df = pd.DataFrame(df[column_name].unique())
        new_df.insert(1, "index", new_df.index)

        df[column_name] = cat_df[column_name].transform(new_df.to_numpy())

    return df


# %%
df = resolve_categorical_variables(df, np.append(categorical_columns, ("fp_id")))


# %% [markdown]
# # Model

# %%
with open("longevity_model.pickle", "rb") as f:
    longevity_model = pickle.load(f)


# %%
y_pred = float(longevity_model.predict(df))
print(y_pred)
