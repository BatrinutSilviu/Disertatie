import xgboost as xg
import pandas as pd

train_data = pd.read_csv("DateMLPregatite.csv")
data = train_data.values
X, y = data[:, :-1], data[:, -1]

# model = XGBRegressor()
# cv = RepeatedKFold(n_splits=10, n_repeats=3, random_state=1)
xgb_r = xg.XGBRegressor(objective ='reg:linear',n_estimators = 10, seed = 123)
# scores = cross_val_score(model, X, y, scoring='neg_mean_absolute_error', cv=cv, n_jobs=-1)

# scores = absolute(scores)
# print('Mean MAE: %.3f (%.3f)' % (scores.mean(), scores.std()) )