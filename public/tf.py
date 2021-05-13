import numpy as np
import pandas as pd
import tensorflow as tf

from tensorflow import keras
from tensorflow.keras import layers
from tensorflow.keras.layers.experimental import preprocessing

# Make numpy printouts easier to read.
np.set_printoptions(precision=3, suppress=True)

url = 'DateMLPregatite.csv'
column_names = ["id","nume","post","iesiri_din_poarta","plonjari","goluri_primite","minute_jucate","boxari","parade","pase_gol","sanse_create","goluri","precizie_pase","suturi","suturi_blocate","precizie_suturi","centrari","pase_cheie","mingi_profunzime","pase","dueluri_aeriene_pierdute","dueluri_aeriene_castigate","degajari","deposedat","driblinguri_incercate","driblinguri_reusite","dueluri_pierdute","dueluri_castigate","faulturi","interceptii","recuperari","deposedari_incercate","deposedari_reusite","faultat","cartonase_galbene","cartonase_rosii","rating"]

raw_dataset = pd.read_csv(url)
dataset = raw_dataset.copy()
dataset.drop('id', axis=1, inplace=True)
dataset.drop('nume', axis=1, inplace=True)
dataset.drop('post', axis=1, inplace=True)
train_dataset = dataset.sample(frac=0.8, random_state=0)
test_dataset = dataset.drop(train_dataset.index)
train_features = train_dataset.copy()
test_features = test_dataset.copy()

train_labels = train_features.pop('rating')
test_labels = test_features.pop('rating')
normalizer = preprocessing.Normalization()
normalizer.adapt(np.array(train_features))
def build_and_compile_model(norm):
    model = keras.Sequential([
        norm,
        layers.Dense(64, activation='relu'),
        layers.Dense(64, activation='relu'),
        layers.Dense(1)
    ])
    model.compile(loss='mean_absolute_error', optimizer=tf.keras.optimizers.Adam(0.001))
    return model

dnn_model = build_and_compile_model(normalizer)
#dnn_model.summary()
#%%time
history = dnn_model.fit(
    train_features, train_labels,
    validation_split=0.2,
    verbose=0, epochs=1000)