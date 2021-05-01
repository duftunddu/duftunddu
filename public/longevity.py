# To add a new cell, type '# %%'
# To add a new markdown cell, type '# %% [markdown]'
# %%
from IPython import get_ipython

# %% [markdown]
# ## Extraction

# %%
get_ipython().run_line_magic("matplotlib", "inline")


# %%
import numpy as np
import pandas as pd

# import xlrd
# import matplotlib as mpl
import matplotlib.pyplot as plt

# import seaborn as sns
from pandas.api.types import CategoricalDtype

# For import export of model
import pickle

from sklearn import linear_model
from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier
from sklearn import metrics

# print(plt.style.available)
# mpl.style.use(['seaborn']) # optional: for ggplot-like style


# %%
# # unidecode(sys.argv[1])
# file = open('longevity_template.pickle', 'rb')

# # Load model from the file
# loaded_pickle = pickle.load(file)

# # close the file
# file.close()

# # print(loaded_pickle)
# # unidecode(sys.argv[1])


# %%
datastore = pd.read_csv(
    "D:\\OneDrive - Institute of Business Administration\\Work\\Duft Und Du\\user_fragrance_review.csv",
    header=0,
)


# %%
df = pd.DataFrame(data=datastore)
df


# %%
df.head()

# %% [markdown]
# ## Cleaning

# %%
df = df[
    df.columns.difference(
        [
            "fba_country_name",
            "fba_time_zone",
            "suitability",
            "sustainability",
            "sillage",
            "like",
            "users_id",
            "users_check",
            "fba_location_country",
            "fba_location_zone",
        ],
        sort=False,
    )
]


# %%
df.dtypes


# %%
df.isnull().sum()


# %%
# Missing Values
# df['suitability'].fillna(df['suitability'].median(), inplace=True)
# df['suitability'].fillna(int(df['suitability'].mean()), inplace=True)

# df['suitability'].fillna(int(0), inplace=True)

df["projection"].fillna(int(0), inplace=True)
df["rain_avg"].fillna(int(0), inplace=True)
df["snow_avg"].fillna(int(0), inplace=True)

# df['user_check'].fillna(int(0), inplace=True)


df["sweat"].fillna(int(df["sweat"].mean()), inplace=True)


df["fragrance_discontinued"].fillna(int(0), inplace=True)
df["brand_discontinued"].fillna(int(0), inplace=True)


# %%
df = df.convert_dtypes()

# Datetime
df["dob"] = df["dob"].astype("datetime64[ns]")
df["apply_time"] = df["apply_time"].astype("datetime64[ns]")
df["wear_off_time"] = df["wear_off_time"].astype("datetime64[ns]")

# Boolean
df["fragrance_discontinued"] = df["fragrance_discontinued"].astype("bool")
df["brand_discontinued"] = df["brand_discontinued"].astype("bool")

# Categorical Variables
df["ufr_id"] = df["ufr_id"].astype(CategoricalDtype(df.ufr_id.unique()))

df["weather_main"] = df["weather_main"].astype(
    CategoricalDtype(df.weather_main.unique())
)
df["weather_description"] = df["weather_description"].astype(
    CategoricalDtype(df.weather_description.unique())
)
df["fp_id"] = df["fp_id"].astype(CategoricalDtype(df.fp_id.unique()))
df["gender"] = df["gender"].astype(CategoricalDtype(df.gender.unique()))
df["profession"] = df["profession"].astype(CategoricalDtype(df.profession.unique()))
df["skin_type"] = df["skin_type"].astype(CategoricalDtype(df.skin_type.unique()))
df["climate"] = df["climate"].astype(CategoricalDtype(df.climate.unique()))
df["season"] = df["season"].astype(CategoricalDtype(df.season.unique()))
df["fp_country"] = df["fp_country"].astype(CategoricalDtype(df.fp_country.unique()))
df["fp_time_zone"] = df["fp_time_zone"].astype(
    CategoricalDtype(df.fp_time_zone.unique())
)
df["fragrance_id"] = df["fragrance_id"].astype(
    CategoricalDtype(df.fragrance_id.unique())
)
df["fragrance"] = df["fragrance"].astype(CategoricalDtype(df.fragrance.unique()))
df["fragrance_gender"] = df["fragrance_gender"].astype(
    CategoricalDtype(df.fragrance_gender.unique())
)
df["fragrance_type"] = df["fragrance_type"].astype(
    CategoricalDtype(df.fragrance_type.unique())
)
df["accord"] = df["accord"].astype(CategoricalDtype(df.accord.unique()))
df["ingredient"] = df["ingredient"].astype(CategoricalDtype(df.ingredient.unique()))
df["brand_id"] = df["brand_id"].astype(CategoricalDtype(df.brand_id.unique()))
df["brand"] = df["brand"].astype(CategoricalDtype(df.brand.unique()))
df["brand_tier"] = df["brand_tier"].astype(CategoricalDtype(df.brand_tier.unique()))
df["bo_location_country"] = df["bo_location_country"].astype(
    CategoricalDtype(df.bo_location_country.unique())
)
df["bo_location_zone"] = df["bo_location_zone"].astype(
    CategoricalDtype(df.bo_location_zone.unique())
)


df.dtypes


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

# Wear Off Time
df["wear_off_time_year"] = df["wear_off_time"].dt.year
df["wear_off_time_month"] = df["wear_off_time"].dt.month
df["wear_off_time_day"] = df["wear_off_time"].dt.day
df["wear_off_time_hour"] = df["wear_off_time"].dt.hour
df["wear_off_time_minute"] = df["wear_off_time"].dt.minute
df["wear_off_time_weekday_name"] = df["wear_off_time"].dt.day_name()

# Type Cast
df["age"] = df["age"].astype("float")

# Drop Apply Time & Wear Off Time
df.drop(["apply_time"], axis=1, inplace=True)
df.drop(["wear_off_time"], axis=1, inplace=True)


# %%
df.describe()


# %%
# use pd.concat to join the new columns with your original dataframe
df = pd.concat([df, pd.get_dummies(df["ufr_id"], prefix="ufr_id")], axis=1)

df = pd.concat(
    [
        df,
        pd.get_dummies(df["apply_time_weekday_name"], prefix="apply_time_weekday_name"),
    ],
    axis=1,
)
df = pd.concat(
    [
        df,
        pd.get_dummies(
            df["wear_off_time_weekday_name"], prefix="wear_off_time_weekday_name"
        ),
    ],
    axis=1,
)

df = pd.concat([df, pd.get_dummies(df["weather_main"], prefix="weather_main")], axis=1)
df = pd.concat(
    [df, pd.get_dummies(df["weather_description"], prefix="weather_description")],
    axis=1,
)

df = pd.concat([df, pd.get_dummies(df["fp_id"], prefix="fp_id")], axis=1)
df = pd.concat([df, pd.get_dummies(df["gender"], prefix="gender")], axis=1)
df = pd.concat([df, pd.get_dummies(df["profession"], prefix="profession")], axis=1)
df = pd.concat([df, pd.get_dummies(df["skin_type"], prefix="skin_type")], axis=1)
df = pd.concat([df, pd.get_dummies(df["climate"], prefix="climate")], axis=1)
df = pd.concat([df, pd.get_dummies(df["season"], prefix="season")], axis=1)

df = pd.concat([df, pd.get_dummies(df["fp_country"], prefix="fp_country")], axis=1)
df = pd.concat([df, pd.get_dummies(df["fp_time_zone"], prefix="fp_time_zone")], axis=1)

df = pd.concat([df, pd.get_dummies(df["fragrance_id"], prefix="fragrance_id")], axis=1)
df = pd.concat([df, pd.get_dummies(df["fragrance"], prefix="fragrance")], axis=1)
df = pd.concat(
    [df, pd.get_dummies(df["fragrance_gender"], prefix="fragrance_gender")], axis=1
)
df = pd.concat(
    [df, pd.get_dummies(df["fragrance_type"], prefix="fragrance_type")], axis=1
)

df = pd.concat([df, pd.get_dummies(df["accord"], prefix="accord")], axis=1)
df = pd.concat([df, pd.get_dummies(df["ingredient"], prefix="ingredient")], axis=1)

df = pd.concat([df, pd.get_dummies(df["brand_id"], prefix="brand_id")], axis=1)
df = pd.concat([df, pd.get_dummies(df["brand"], prefix="brand")], axis=1)
df = pd.concat([df, pd.get_dummies(df["brand_tier"], prefix="brand_tier")], axis=1)
df = pd.concat(
    [df, pd.get_dummies(df["bo_location_country"], prefix="bo_location_country")],
    axis=1,
)
df = pd.concat(
    [df, pd.get_dummies(df["bo_location_zone"], prefix="bo_location_zone")], axis=1
)


# %%
# now drop the original 'country' column (you don't need it anymore)
df.drop(["ufr_id"], axis=1, inplace=True)

df.drop(["apply_time_weekday_name"], axis=1, inplace=True)
df.drop(["wear_off_time_weekday_name"], axis=1, inplace=True)

df.drop(["weather_main"], axis=1, inplace=True)
df.drop(["weather_description"], axis=1, inplace=True)

df.drop(["fp_id"], axis=1, inplace=True)
df.drop(["gender"], axis=1, inplace=True)
df.drop(["profession"], axis=1, inplace=True)
df.drop(["skin_type"], axis=1, inplace=True)
df.drop(["climate"], axis=1, inplace=True)
df.drop(["season"], axis=1, inplace=True)

df.drop(["fp_country"], axis=1, inplace=True)
df.drop(["fp_time_zone"], axis=1, inplace=True)

df.drop(["fragrance_id"], axis=1, inplace=True)
df.drop(["fragrance"], axis=1, inplace=True)
df.drop(["fragrance_gender"], axis=1, inplace=True)
df.drop(["fragrance_type"], axis=1, inplace=True)

df.drop(["accord"], axis=1, inplace=True)
df.drop(["ingredient"], axis=1, inplace=True)

df.drop(["brand_id"], axis=1, inplace=True)
df.drop(["brand"], axis=1, inplace=True)
df.drop(["brand_tier"], axis=1, inplace=True)
df.drop(["bo_location_country"], axis=1, inplace=True)
df.drop(["bo_location_zone"], axis=1, inplace=True)

# To Be Included Later
# df.drop(['indoor_time_percentage'],axis=1, inplace=True)
# df.drop(['number_of_sprays'],axis=1, inplace=True)
df.drop(["projection"], axis=1, inplace=True)


# %%
print(df.shape)
print(df.duplicated(keep="first").sum())


# %%
df.head()


# %%
# Use this and fix this
# aggregation_functions = {'longevity': 'first', 'amount': 'sum', 'name': 'first'}
# df_new = df.groupby(df['ufr_id']).aggregate(aggregation_functions)
# df_new.head()


# %%
df.drop_duplicates(subset=None, keep="first", inplace=True)
df.shape


# %%
# Columns with any null values
df.columns[df.isna().any()].tolist()


# %%
df.describe()

# %% [markdown]
# # Model
# %% [markdown]
# ## Train

# %%
# define the target variable (dependent variable) as y
y = df.longevity
y = y.astype("int")

# create training and testing vars
X_train, X_test, y_train, y_test = train_test_split(df, y, test_size=0.2)
print(X_train.shape, y_train.shape)
print(X_test.shape, y_test.shape)


# %%
# Create Decision Tree classifer object
clf = DecisionTreeClassifier(criterion="entropy")

#%%
# Train Decision Tree Classifer
model = clf.fit(X_train, y_train)

# %% [markdown]
# ## Test

# %%
# Predict the response for test dataset
y_pred = model.predict(X_test)

# %% [markdown]
# ## Evaluate

# %%
## The line / model
plt.scatter(y_test, y_pred)
plt.xlabel("True Values")
plt.ylabel("Predictions")


# %%
# The coefficients
# print('Coefficients: \n', model.coef_)
# The mean squared error
print("Mean squared error: %.2f" % mean_squared_error(y_test, y_pred))
# The coefficient of determination: 1 is perfect prediction
print("Coefficient of determination: %.2f" % r2_score(y_test, y_pred))


# %%
print("Mean Absolute Error:", metrics.mean_absolute_error(y_test, y_pred))
print("Mean Squared Error:", metrics.mean_squared_error(y_test, y_pred))
print("Root Mean Squared Error:", np.sqrt(metrics.mean_squared_error(y_test, y_pred)))

# %% [markdown]
# ## Save the model in pickle

# %%
# Pickling the list
file = open("longevity_model.pickle", "wb")

# dump information to that file
list_pickle = pickle.dump(model, file)

# close the file
file.close()


# %%
# Open file to
file = open("longevity_model.pickle", "rb")

# Load model from the file
loaded_pickle = pickle.load(file)

# close the file
file.close()


# %%
loaded_pickle

# %% [markdown]
# # Write Column Names

# %%
def listToString(s):

    # initialize an empty string
    str1 = "\n"

    # return string
    return str1.join(s)


# %%
file = open("column_names.txt", "w")

# dump information to that file
file.write(listToString(df.columns))

# close the file
file.close()

# %% [markdown]
# # END

