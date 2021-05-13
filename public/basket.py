from sklearn.preprocessing import PolynomialFeatures, normalize, StandardScaler, MinMaxScaler
from sklearn.linear_model import SGDRegressor, LinearRegression, Ridge, Lasso, ElasticNet
from sklearn.neural_network import MLPRegressor
from sklearn.svm import SVR
from sklearn.ensemble import RandomForestRegressor, GradientBoostingRegressor, BaggingRegressor, AdaBoostRegressor
from sklearn.utils import shuffle
import pandas as pd

data_frame = pd.read_csv("DateMLPregatite.csv")

def get_predictions_for_regression_model(model, poly_fit, train_data, test_data, scaler=None):
    train_x = train_data[train_regression_columns].to_numpy()
    train_y = train_data[target_reg_columns].to_numpy()

    train_x, train_y = shuffle(train_x, train_y)
    train_y = train_y.reshape(train_y.shape[0], )
    
    test_x = test_data[test_reg_columns].to_numpy()
    test_x = np.nan_to_num(test_x)
    
    if poly_fit is not None:
        train_x = poly_fit.fit_transform(train_x)
        test_x = poly_fit.fit_transform(test_x)
    
    if scaler is not None:
        train_x = scaler.fit_transform(train_x)
        test_x = scaler.fit_transform(test_x)
    
    model.fit(train_x, train_y)
    predict_y = model.predict(test_x)
    sorted_indices = np.argsort(predict_y)[::-1]
    predictions = predict_y[sorted_indices]
    
    #formatted_preds = []
    #if should_print:
        #print(f"Predictions:")
    #for i in range(10):
        #if predictions[i] < 0:
            #break
        #if should_print:
            #print(f"{i+1}. {top_players.iloc[sorted_indices[i]].Player}: {predictions[i]}")
        #formatted_preds.append((top_players.iloc[sorted_indices[i]].Player, predictions[i]))
    #return formatted_preds
    return predictions
    
get_predictions_for_regression_model(
    model = GradientBoostingRegressor(n_estimators=50, learning_rate=0.1, subsample=1.0),
    poly_fit = PolynomialFeatures(degree=2, interaction_only=False),
    train_data=data_frame,
    test_data=test_data
)

get_predictions_for_regression_model(
    model = GradientBoostingRegressor(n_estimators=50, learning_rate=0.1, subsample=1.0),
    poly_fit = PolynomialFeatures(degree=2, interaction_only=True),
    train_data=data_frame,
    test_data=test_data
)

get_predictions_for_regression_model(
    model = RandomForestRegressor(n_estimators=50),
    poly_fit = PolynomialFeatures(degree=3, interaction_only=True),
    train_data=data_frame,
    test_data=test_data
)


get_predictions_for_regression_model(
    model = RandomForestRegressor(n_estimators=100),
    poly_fit = PolynomialFeatures(degree=2, interaction_only=True),
    train_data=data_frame,
    test_data=test_data
)

get_predictions_for_regression_model(
    model = Ridge(alpha=10.0),
    poly_fit = PolynomialFeatures(degree=2, interaction_only=True),
    train_data=data_frame,
    test_data=test_data
)

get_predictions_for_regression_model(
    model = LinearRegression(normalize=True),
    poly_fit = PolynomialFeatures(degree=2, interaction_only=True),
    train_data=data_frame,
    test_data=test_data
)

get_predictions_for_regression_model(
    model = SVR(C=100, gamma=0.001),
    poly_fit = None,
    train_data=data_frame,
    test_data=test_data
)

get_predictions_for_regression_model(
    model = SVR(C=100, gamma=0.01),
    poly_fit = None,
    train_data=data_frame,
    test_data=test_data,
    scaler=MinMaxScaler()
)

get_predictions_for_regression_model(
    model = GradientBoostingRegressor(n_estimators=50, learning_rate=0.01 ,subsample=0.5),
    poly_fit = None,
    train_data=data_frame,
    test_data=test_data,
)