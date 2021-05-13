import pandas as pd
import numpy as np
import math

def sigmoid(x):
    return max(0.0, x)

def sigmoid_p(x):
    if input > 0:
        return 1
    else:
        return 0

#portar 9 -8 7
#fundas -7 7 9
#mijlocas -8 9 7
#atacant 7 8 -7

data = [["mijlocas", 0.6, 0.1, 0.6, 0.3],
        ["mijlocas", 0.3, 0.4, 0.7, 6.1],
        ["mijlocas", 0.5, 0.5, 0.5, 4],
        ["atacant", 0.6, 0.1, 0.6, 0.8],
        ["atacant", 0.3, 0.4, 0.7, 0.4],
        ["atacant", 0.5, 0.5, 0.5, 4],
        ["fundas", 0.6, 0.1, 0.5, 1],
        ["fundas", 0.3, 0.4, 0.7, 7],
        ["fundas", 0.5, 0.5, 0.5, 4.5],
        ["portar", 0.6, 0.1, 0.5, 8.1],
        ["portar", 0.3, 0.4, 0.7, 4.4],
        ["portar", 0.5, 0.5, 0.5, 4]]

mystery_flower = ["fundas", 0.2, 0.2, 0.5]

def train():
    w1Portar = 1
    w2Portar = 1
    w3Portar = 1
    w1Fundas = 1
    w2Fundas = 1
    w3Fundas = 1
    w1Mijlocas = 1
    w2Mijlocas = 1
    w3Mijlocas = 1
    w1Atacant = 1
    w2Atacant = 1
    w3Atacant = 1
    bPortar = 1
    bFundas = 1
    bMijlocas = 1
    bAtacant = 1

    iterations = 10000
    learning_rate = 0.01
    costs = []
    
    for i in range(iterations):
        ri = np.random.randint(len(data))
        point = data[ri]
        target = point[4]

        if point[0] == "portar":
            z = float(point[1]) * w1Portar + float(point[2]) * w2Portar + float(point[3]) * w3Portar + bPortar
        if point[0] == "fundas":
            z = float(point[1]) * w1Fundas + float(point[2]) * w2Fundas + float(point[3]) * w3Fundas + bFundas
        if point[0] == "mijlocas":
            z = float(point[1]) * w1Mijlocas + float(point[2]) * w2Mijlocas + float(point[3]) * w3Mijlocas + bMijlocas
        if point[0] == "atacant":
            z = float(point[1]) * w1Atacant + float(point[2]) * w2Atacant + float(point[3]) * w3Atacant + bAtacant

        pred = sigmoid(z) # networks prediction
        
        # cost for current random point
        cost = np.square(pred - target)
        #print(cost)
        
        # print the cost over all data points every 1k iters
        # if i % 100 == 0:
            # c = 0
            # for j in range(len(data)):
                # p = data[j]
                # p_pred = sigmoid(w1 * p[0] + w2 * p[1] + b)
                # c += np.square(p_pred - p[2])
            # costs.append(c)
        
        dcost_dpred = 2 * (pred - target)
        dpred_dz = sigmoid_p(z)
        
        dz_dw1 = point[1]
        dz_dw2 = point[2]
        dz_dw3 = point[3]

        dcost_dz = dcost_dpred * dpred_dz
        
        dcost_dw1 = dcost_dz * dz_dw1
        dcost_dw2 = dcost_dz * dz_dw2
        dcost_dw3 = dcost_dz * dz_dw3
        dcost_db = dcost_dz
        
        if point[0] == "portar":
            w1Portar = w1Portar - learning_rate * dcost_dw1
            w2Portar = w2Portar - learning_rate * dcost_dw2
            w3Portar = w3Portar - learning_rate * dcost_dw3
            bPortar = bPortar - learning_rate * dcost_db
        if point[0] == "fundas":
            w1Fundas = w1Fundas - learning_rate * dcost_dw1
            w2Fundas = w2Fundas - learning_rate * dcost_dw2
            w3Fundas = w3Fundas - learning_rate * dcost_dw3
            bFundas = bFundas - learning_rate * dcost_db
        if point[0] == "mijlocas":
            w1Mijlocas = w1Mijlocas - learning_rate * dcost_dw1
            w2Mijlocas = w2Mijlocas - learning_rate * dcost_dw2
            w3Mijlocas = w3Mijlocas - learning_rate * dcost_dw3
            bMijlocas = bMijlocas - learning_rate * dcost_db
        if point[0] == "atacant":
            w1Atacant = w1Atacant - learning_rate * dcost_dw1
            w2Atacant = w2Atacant - learning_rate * dcost_dw2
            w3Atacant = w3Atacant - learning_rate * dcost_dw3
            bAtacant = bAtacant - learning_rate * dcost_db
        
    return w1Portar, w2Portar, w3Portar, w1Fundas, w2Fundas, w3Fundas, w1Mijlocas, w2Mijlocas, w3Mijlocas, w1Atacant, w2Atacant, w3Atacant, bPortar, bFundas, bMijlocas, bAtacant
        
w1Portar, w2Portar, w3Portar, w1Fundas, w2Fundas, w3Fundas, w1Mijlocas, w2Mijlocas, w3Mijlocas, w1Atacant, w2Atacant, w3Atacant, bPortar, bFundas, bMijlocas, bAtacant = train()

if mystery_flower[0] == "portar":
    z = float(mystery_flower[1]) * w1Portar + float(mystery_flower[2]) * w2Portar + float(mystery_flower[3]) * w3Portar + bPortar
if mystery_flower[0] == "fundas":
    z = float(mystery_flower[1]) * w1Fundas + float(mystery_flower[2]) * w2Fundas + float(mystery_flower[3]) * w3Fundas + bFundas
if mystery_flower[0] == "mijlocas":
    z = float(mystery_flower[1]) * w1Mijlocas + float(mystery_flower[2]) * w2Mijlocas + float(mystery_flower[3]) * w3Mijlocas + bMijlocas
if mystery_flower[0] == "atacant":
    z = float(mystery_flower[1]) * w1Atacant + float(mystery_flower[2]) * w2Atacant + float(mystery_flower[3]) * w3Atacant + bAtacant
    
pred = sigmoid(z)
print(str(pred)+" "+str(w1Fundas)+" "+str(w2Fundas)+" "+str(w3Fundas)+" "+str(bFundas))
