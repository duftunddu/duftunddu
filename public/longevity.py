# To add a new cell, type '# %%'
# To add a new markdown cell, type '# %% [markdown]'
# %%
from IPython import get_ipython

# %% [markdown]
# ## Extraction

# %%
get_ipython().run_line_magic('matplotlib', 'inline')
# %%
import numpy as np
import pandas as pd
# import xlrd
# import matplotlib as mpl
# import matplotlib.pyplot as plt
# import seaborn as sns
from pandas.api.types import CategoricalDtype

# For import export of model
import pickle

from sklearn import linear_model
from sklearn.model_selection import train_test_split

# print(plt.style.available)
# mpl.style.use(['seaborn']) # optional: for ggplot-like style


# %%
# file='C:/Users/Abdul Samad/OneDrive - Institute of Business Administration/Work/Tutorials/Machine Learning/Python/Visualizing Data/Canada.xlsx'
# df_full=pd.ExcelFile(file) # load spreadsheet
# print(df_full.sheet_names) #print the sheets names
# df = df_full.parse('Canada by Citizenship', skiprows=range(20), skip_footer=20)

# file_path = 'D:/OneDrive - Institute of Business Administration/Work/Duft Und Du/user_fragrance_review.csv'
# df = pd.read_csv(file_path)


# %%
# df.head()

# %% [markdown]
# ## Cleaning

# %%
df.dtypes


# %%
# df.isnull().sum()
# %%
# Missing Values
# df['suitability'].fillna(df['suitability'].median(), inplace=True)
# df['suitability'].fillna(int(df['suitability'].mean()), inplace=True)

df['suitability'].fillna(int(0), inplace=True)

df['projection'].fillna(int(0), inplace=True)
df['rain_avg'].fillna(int(0), inplace=True)
df['snow_avg'].fillna(int(0), inplace=True)

df['user_check'].fillna(int(0), inplace=True)


df['sweat'].fillna(int(df['sweat'].mean()), inplace=True)


df['fragrance_discontinued'].fillna(int(0), inplace=True)
df['brand_discontinued'].fillna(int(0), inplace=True)


# %%
df = df.convert_dtypes()

# Datetime
df['dob']               = df['dob'].astype('datetime64[ns]')
df['apply_time']        = df['apply_time'].astype('datetime64[ns]')
df['wear_off_time']     = df['wear_off_time'].astype('datetime64[ns]')

# Boolean
df['user_check']                = df['user_check'].astype('bool')
df['fragrance_discontinued']    = df['fragrance_discontinued'].astype('bool')
df['brand_discontinued']        = df['brand_discontinued'].astype('bool')

# Categorical Variables
df["ufr_id"]                = df["ufr_id"].astype(CategoricalDtype(df.ufr_id.unique()))
df["users_id"]              = df["users_id"].astype(CategoricalDtype(df.users_id.unique()))
df["fba_country_name"]      = df["fba_country_name"].astype(CategoricalDtype(df.fba_country_name.unique()))
df["fba_time_zone"]         = df["fba_time_zone"].astype(CategoricalDtype(df.fba_time_zone.unique()))
df["weather_main"]          = df["weather_main"].astype(CategoricalDtype(df.weather_main.unique()))
df["weather_description"]   = df["weather_description"].astype(CategoricalDtype(df.weather_description.unique()))
df["fp_id"]                 = df["fp_id"].astype(CategoricalDtype(df.fp_id.unique()))
df["gender"]                = df["gender"].astype(CategoricalDtype(df.gender.unique()))
df["profession"]            = df["profession"].astype(CategoricalDtype(df.profession.unique()))
df["skin_type"]             = df["skin_type"].astype(CategoricalDtype(df.skin_type.unique()))
df["climate"]               = df["climate"].astype(CategoricalDtype(df.climate.unique()))
df["season"]                = df["season"].astype(CategoricalDtype(df.season.unique()))
df["fp_country"]            = df["fp_country"].astype(CategoricalDtype(df.fp_country.unique()))
df["fp_time_zone"]          = df["fp_time_zone"].astype(CategoricalDtype(df.fp_time_zone.unique()))
df["fragrance_id"]          = df["fragrance_id"].astype(CategoricalDtype(df.fragrance_id.unique()))
df["fragrance"]             = df["fragrance"].astype(CategoricalDtype(df.fragrance.unique()))
df["fragrance_gender"]      = df["fragrance_gender"].astype(CategoricalDtype(df.fragrance_gender.unique()))
df["fragrance_type"]        = df["fragrance_type"].astype(CategoricalDtype(df.fragrance_type.unique()))
df["accord"]                = df["accord"].astype(CategoricalDtype(df.accord.unique()))
df["ingredient"]            = df["ingredient"].astype(CategoricalDtype(df.ingredient.unique()))
df["brand_id"]              = df["brand_id"].astype(CategoricalDtype(df.brand_id.unique()))
df["brand"]                 = df["brand"].astype(CategoricalDtype(df.brand.unique()))
df["brand_tier"]            = df["brand_tier"].astype(CategoricalDtype(df.brand_tier.unique()))
df["bo_location_country"]   = df["bo_location_country"].astype(CategoricalDtype(df.bo_location_country.unique()))
df["bo_location_zone"]      = df["bo_location_zone"].astype(CategoricalDtype(df.bo_location_zone.unique()))
df["fba_location_country"]  = df["fba_location_country"].astype(CategoricalDtype(df.fba_location_country.unique()))
df["fba_location_zone"]     = df["fba_location_zone"].astype(CategoricalDtype(df.fba_location_zone.unique()))


df.dtypes


# %%
# Calcualting Age

now = pd.to_datetime('now')
df['age'] = (now - df['dob']).dt.total_seconds() / (60*60*24*365.25)
df.drop(['dob'],axis=1, inplace=True)


# %%
# Sorting out Dates

# Apply Time
df['apply_time_year']          = df['apply_time'].dt.year
df['apply_time_month']         = df['apply_time'].dt.month
df['apply_time_day']           = df['apply_time'].dt.day
df['apply_time_hour']          = df['apply_time'].dt.hour
df['apply_time_minute']        = df['apply_time'].dt.minute
df['apply_time_weekday_name']  = df['apply_time'].dt.day_name()

# Wear Off Time
df['wear_off_time_year']          = df['wear_off_time'].dt.year
df['wear_off_time_month']         = df['wear_off_time'].dt.month
df['wear_off_time_day']           = df['wear_off_time'].dt.day
df['wear_off_time_hour']          = df['wear_off_time'].dt.hour
df['wear_off_time_minute']        = df['wear_off_time'].dt.minute
df['wear_off_time_weekday_name']  = df['wear_off_time'].dt.day_name()

# Type Cast
df['age']               = df['age'].astype('float')

# Drop Apply Time & Wear Off Time
df.drop(['apply_time'],axis=1, inplace=True)
df.drop(['wear_off_time'],axis=1, inplace=True)


# %%
df.describe()


# %%
# use pd.concat to join the new columns with your original dataframe
df = pd.concat([df,pd.get_dummies(df['ufr_id'], prefix='ufr_id')],axis=1)
df = pd.concat([df,pd.get_dummies(df['users_id'], prefix='users_id')],axis=1)

df = pd.concat([df,pd.get_dummies(df['apply_time_weekday_name'], prefix='apply_time_weekday_name')],axis=1)
df = pd.concat([df,pd.get_dummies(df['wear_off_time_weekday_name'], prefix='wear_off_time_weekday_name')],axis=1)

df = pd.concat([df,pd.get_dummies(df['fba_country_name'], prefix='fba_country_name')],axis=1)
df = pd.concat([df,pd.get_dummies(df['fba_time_zone'], prefix='fba_time_zone')],axis=1)

df = pd.concat([df,pd.get_dummies(df['weather_main'], prefix='weather_main')],axis=1)
df = pd.concat([df,pd.get_dummies(df['weather_description'], prefix='weather_description')],axis=1)

df = pd.concat([df,pd.get_dummies(df['fp_id'], prefix='fp_id')],axis=1)
df = pd.concat([df,pd.get_dummies(df['gender'], prefix='gender')],axis=1)
df = pd.concat([df,pd.get_dummies(df['profession'], prefix='profession')],axis=1)
df = pd.concat([df,pd.get_dummies(df['skin_type'], prefix='skin_type')],axis=1)
df = pd.concat([df,pd.get_dummies(df['climate'], prefix='climate')],axis=1)
df = pd.concat([df,pd.get_dummies(df['season'], prefix='season')],axis=1)

df = pd.concat([df,pd.get_dummies(df['fp_country'], prefix='fp_country')],axis=1)
df = pd.concat([df,pd.get_dummies(df['fp_time_zone'], prefix='fp_time_zone')],axis=1)

df = pd.concat([df,pd.get_dummies(df['fragrance_id'], prefix='fragrance_id')],axis=1)
df = pd.concat([df,pd.get_dummies(df['fragrance'], prefix='fragrance')],axis=1)
df = pd.concat([df,pd.get_dummies(df['fragrance_gender'], prefix='fragrance_gender')],axis=1)
df = pd.concat([df,pd.get_dummies(df['fragrance_type'], prefix='fragrance_type')],axis=1)

df = pd.concat([df,pd.get_dummies(df['accord'], prefix='accord')],axis=1)
df = pd.concat([df,pd.get_dummies(df['ingredient'], prefix='ingredient')],axis=1)

df = pd.concat([df,pd.get_dummies(df['brand_id'], prefix='brand_id')],axis=1)
df = pd.concat([df,pd.get_dummies(df['brand'], prefix='brand')],axis=1)
df = pd.concat([df,pd.get_dummies(df['brand_tier'], prefix='brand_tier')],axis=1)
df = pd.concat([df,pd.get_dummies(df['bo_location_country'], prefix='bo_location_country')],axis=1)
df = pd.concat([df,pd.get_dummies(df['bo_location_zone'], prefix='bo_location_zone')],axis=1)

df = pd.concat([df,pd.get_dummies(df['fba_location_country'], prefix='fba_location_country')],axis=1)
df = pd.concat([df,pd.get_dummies(df['fba_location_zone'], prefix='fba_location_zone')],axis=1)


# %%
# now drop the original 'country' column (you don't need it anymore)
df.drop(['ufr_id'],axis=1, inplace=True)
df.drop(['users_id'],axis=1, inplace=True)

df.drop(['apply_time_weekday_name'],axis=1, inplace=True)
df.drop(['wear_off_time_weekday_name'],axis=1, inplace=True)

df.drop(['fba_country_name'],axis=1, inplace=True)
df.drop(['fba_time_zone'],axis=1, inplace=True)

df.drop(['weather_main'],axis=1, inplace=True)
df.drop(['weather_description'],axis=1, inplace=True)

df.drop(['fp_id'],axis=1, inplace=True)
df.drop(['gender'],axis=1, inplace=True)
df.drop(['profession'],axis=1, inplace=True)
df.drop(['skin_type'],axis=1, inplace=True)
df.drop(['climate'],axis=1, inplace=True)
df.drop(['season'],axis=1, inplace=True)

df.drop(['fp_country'],axis=1, inplace=True)
df.drop(['fp_time_zone'],axis=1, inplace=True)

df.drop(['fragrance_id'],axis=1, inplace=True)
df.drop(['fragrance'],axis=1, inplace=True)
df.drop(['fragrance_gender'],axis=1, inplace=True)
df.drop(['fragrance_type'],axis=1, inplace=True)

df.drop(['accord'],axis=1, inplace=True)
df.drop(['ingredient'],axis=1, inplace=True)

df.drop(['brand_id'],axis=1, inplace=True)
df.drop(['brand'],axis=1, inplace=True)
df.drop(['brand_tier'],axis=1, inplace=True)
df.drop(['bo_location_country'],axis=1, inplace=True)
df.drop(['bo_location_zone'],axis=1, inplace=True)

df.drop(['fba_location_country'],axis=1, inplace=True)
df.drop(['fba_location_zone'],axis=1, inplace=True)

# To Be Included Later
df.drop(['indoor_time_percentage'],axis=1, inplace=True)
df.drop(['number_of_sprays'],axis=1, inplace=True)
df.drop(['projection'],axis=1, inplace=True)
df.drop(['sillage'],axis=1, inplace=True)
df.drop(['like'],axis=1, inplace=True)


# %%
print(df.shape)
print(df.duplicated(keep='first').sum())


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
# df_long.head()
# df_suit.head()
# df_sust.head()


# %%
df.describe()


# %%
# Longevity
df_long = df[df.columns.difference(['suitability',  'sustainability'], sort=False)]
df_suit = df[df.columns.difference(['longevity',    'sustainability'], sort=False)]
df_sust = df[df.columns.difference(['longevity',    'suitability'], sort=False)]

# %% [markdown]
# ## Train
# %% [markdown]
# ### Longevity
# 

# %%
# define the target variable (dependent variable) as y
y = df.longevity


# %%
# create training and testing vars
X_train, X_test, y_train, y_test = train_test_split(df, y, test_size=0.2)
print (X_train.shape, y_train.shape)
print (X_test.shape, y_test.shape)


# %%
# fit a model
lm = linear_model.LinearRegression()
model = lm.fit(X_train, y_train)

# %% [markdown]
# ## Test

# %%
# Test
predictions = lm.predict(X_test)


# %%
predictions

# %% [markdown]
# ## Evaluate

# %%
## The line / model
# plt.scatter(y_test, predictions)
# plt.xlabel(“True Values”)
# plt.ylabel(“Predictions”)

# %% [markdown]
# ## Save the model in pickle

# %%
#Pickling the list
file = open('model', 'wb')

# dump information to that file
list_pickle = pickle.dump(model, file)

# close the file
file.close()


# %%
# Open file to 
file = open('model', 'rb')

# Load model from the file
loaded_pickle = pickle.load(file)

# close the file
file.close()


# %%
loaded_pickle

# %% [markdown]
# # END

# %%
# y = diabetes.longevity # define the target variable (dependent variable) as y


# %%
# ax = sns.regplot(x = 'year', y = 'total', data=df)


# %%
# df.drop(['AREA','REG','DEV','Type','Coverage'], axis=1, inplace=True)
# df.rename(columns={'OdName':'Country', 'AreaName':'Continent', 'RegName':'Region'}, inplace=True)
# df['Total'] = df.sum(axis=1)
# df.head()


# %%
# df.set_index('Country', inplace=True)
# df.index.name = None


# %%
# df.columns = list(map(str, df.columns))

# years = list(map(str, range(1980, 2014)))


# %%
# df.head()


# %%
# df.sort_values('Total', ascending=False, axis=0, inplace=True)
# df.head(10)


# %%
# df.sort_values('Total', ascending=False, axis=0, inplace=True)

# # dft = df.loc('Unknown')
# # df.drop(df.loc('Unknown'))
# dft = df.drop(index = 'Unknown')
# dft = dft.drop(index = 'Total')

# # get the top 5 entries
# # df_top5 = df[1:6]
# # df_top5 = dft.head()

# # transpose the dataframe
# # df_top5 = df_top5[years].transpose() 

# # df_top5.head()

# # we can use the sum() method to get the total population per year
# df_tot = pd.DataFrame(dft[years].sum(axis=0))

# # change the years to type float (useful for regression later on)
# df_tot.index = map(float, df_tot.index)

# # reset the index to put in back in as a column in the df_tot dataframe
# df_tot.reset_index(inplace=True)

# # rename columns
# df_tot.columns = ['year', 'total']

# # view the final dataframe
# df_tot.head()


# %%
# ax = sns.regplot(x='year', y='total', data=df_tot)


# %%
# ax = sns.regplot(x='year', y='total', data=df_tot, color='red')


# %%
# ax = sns.regplot(x='year', y='total', data=df_tot, color='green', marker='+')


# %%
# plt.figure(figsize=(15, 10))
# ax = sns.regplot(x='year', y='total', data=df_tot, color='green', marker='+', scatter_kws={'s': 200})

# ax.set(xlabel='Year', ylabel='Total Immigration') # add x- and y-labels
# ax.set_title('Total Immigration to Canada from 1980 - 2013') # add title


# %%
# plt.figure(figsize=(15, 10))

# sns.set(font_scale=1.5)

# ax = sns.regplot(x='year', y='total', data=df_tot, color='green', marker='+', scatter_kws={'s': 200})
# ax.set(xlabel='Year', ylabel='Total Immigration')
# ax.set_title('Total Immigration to Canada from 1980 - 2013')


# %%
# plt.figure(figsize=(15, 10))

# sns.set(font_scale=1.5)
# sns.set_style('ticks') # change background to white background

# ax = sns.regplot(x='year', y='total', data=df_tot, color='green', marker='+', scatter_kws={'s': 200})
# ax.set(xlabel='Year', ylabel='Total Immigration')
# ax.set_title('Total Immigration to Canada from 1980 - 2013')


# %%
# plt.figure(figsize=(15, 10))

# sns.set(font_scale=1.5)
# sns.set_style('whitegrid')

# ax = sns.regplot(x='year', y='total', data=df_tot, color='green', marker='+', scatter_kws={'s': 200})
# ax.set(xlabel='Year', ylabel='Total Immigration')
# ax.set_title('Total Immigration to Canada from 1980 - 2013')


# %%
# ### type your answer here

# dfr = dft.loc[['Denmark', 'Sweden', 'Norway'], years].transpose()

# df_total = pd.DataFrame(dfr.sum(axis=1))

# df_total.reset_index(inplace=True)

# df_total.columns = ['year', 'total']
# df_total.head()

# df_total['year'] = df_total['year'].astype(int)

# plt.figure(figsize = (15,10))

# sns.set_style('whitegrid')
# sns.set(font_scale=1.5)

# ax = sns.regplot(x='year', y='total', data=df_total, color='red', marker='+', scatter_kws={'s': 200})
# ax.set(xlabel='Year', ylabel='Total Immigration')
# ax.set_title('Total Immigrationn from Denmark, Sweden, and Norway to Canada from 1980 - 2013\n')

# plt.show()


# %%



