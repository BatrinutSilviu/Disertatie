import pandas as pd
import numpy as np
import math

train_data = pd.read_csv("WhoScoredFinal1.csv")
#30 coloane, de la 0 la 29

# 0-pozitia, 1-minute, 2-goluri, 3-assisturi, 4-galbene, 5-rosii, 6-suturi/, 7-aerials/, 8-MoM, 9-nume, 10-SuccesPase
# 11-deposedare/, 12-interceptii/, 13-faulturi/, 14-offsideuriCastigate/, 15-degajare/, 16-FostDriblat/, 17-blocari/
# 18-autoGol, 19-paseCheie/, 20-DriblunguriCastigate/, 21-CevaFaulturiProbabilPrimite/, 22-PrinsInOffsideuri/, 23-deposedat/
# 24-recuperari/, 25-paseTotale/, 26-centrariPrecise/, 27-mingiLungiPrecise/, 28- verticalizariPrecise/, 29- rating

#8 portar = 4-galbene, 5-rosii, 7-aerials/, 8-MoM, 10-SuccesPase, 15-degajare/, 25-paseTotale/, 27-mingiLungiPrecise/
#fundas = 2-goluri, 3-assisturi, 4-galbene, 5-rosii, 7-aerials/, 8-MoM, 10-SuccesPase,11-deposedare/, 12-interceptii/, 13-faulturi/, 14-offsideuriCastigate/, 15-degajare/, 16-FostDriblat/, 17-blocari/, 18-autoGol, 23-deposedat/, 
#mijlocas =  2-goluri, 3-assisturi, 4-galbene, 5-rosii, 6-suturi/, 8-MoM, 10-SuccesPase, 11-deposedare/, 12-interceptii/, 13-faulturi/, 14-offsideuriCastigate/, 15-degajare/, 16-FostDriblat/, 17-blocari/, 18-autoGol, 19-paseCheie/, 20-DriblunguriCastigate/, 21-CevaFaulturiProbabilPrimite/, 22-PrinsInOffsideuri/, 23-deposedat/, 24-recuperari/, 25-paseTotale/, 26-centrariPrecise/, 27-mingiLungiPrecise/, 28- verticalizariPrecise/
#atacant = 2-goluri, 3-assisturi, 4-galbene, 5-rosii, 6-suturi/, 7-aerials/, 8-MoM, 10-SuccesPase, 18-autoGol, 19-paseCheie/, 20-DriblunguriCastigate/, 21-CevaFaulturiProbabilPrimite/, 22-PrinsInOffsideuri/, 23-deposedat/,25-paseTotale/, 26-centrariPrecise/, 27-mingiLungiPrecise/, 28- verticalizariPrecise/

#print(train_data.values[0][29])

# data = [[5,   0,   90],
        # [0,   5,   10],
        # [4,   1,   80],
        # [3,   1,   70],
        # [4,   0,   85],
        # [1,   5,   15],
        # [2,   4,   20],
        # [1,   0,   50]]


def sigmoid(x):
    #return 1/(1+np.exp(-x))
    return max(0.0, x)

def sigmoid_p(x):
    #return sigmoid(x) * (1-sigmoid(x))
    if input > 0:
        return 1
    else:
        return 0

def train():
    #random init of weights
    w1Portar = 1
    w2Portar = 1
    w3Portar = 1
    w4Portar = 1
    w5Portar = 1
    w6Portar = 1
    w7Portar = 1
    w8Portar = 1
    w1Fundas = 1
    w2Fundas = 1
    w3Fundas = 1
    w4Fundas = 1
    w5Fundas = 1
    w6Fundas = 1
    w7Fundas = 1
    w8Fundas = 1
    w9Fundas = 1
    w10Fundas = 1
    w11Fundas = 1
    w12Fundas = 1
    w13Fundas = 1
    w14Fundas = 1
    w15Fundas = 1
    w16Fundas = 1
    w17Fundas = 1
    w18Fundas = 1
    w19Fundas = 1
    w20Fundas = 1
    w21Fundas = 1
    w22Fundas = 1
    w23Fundas = 1
    w24Fundas = 1
    w25Fundas = 1
    w26Fundas = 1
    w1Mijlocas = 1
    w2Mijlocas = 1
    w3Mijlocas = 1
    w4Mijlocas = 1
    w5Mijlocas = 1
    w6Mijlocas = 1
    w7Mijlocas = 1
    w8Mijlocas = 1
    w9Mijlocas = 1
    w10Mijlocas = 1
    w11Mijlocas = 1
    w12Mijlocas = 1
    w13Mijlocas = 1
    w14Mijlocas = 1
    w15Mijlocas = 1
    w16Mijlocas = 1
    w17Mijlocas = 1
    w18Mijlocas= 1
    w19Mijlocas = 1
    w20Mijlocas = 1
    w21Mijlocas = 1
    w22Mijlocas = 1
    w23Mijlocas = 1
    w24Mijlocas= 1
    w25Mijlocas = 1
    w26Mijlocas = 1
    w1Atacant = 1
    w2Atacant = 1
    w3Atacant = 1
    w4Atacant = 1
    w5Atacant = 1
    w6Atacant = 1
    w7Atacant = 1
    w8Atacant = 1
    w9Atacant = 1
    w10Atacant = 1
    w11Atacant = 1
    w12Atacant = 1
    w13Atacant = 1
    w14Atacant = 1
    w15Atacant = 1
    w16Atacant = 1
    w17Atacant = 1
    w18Atacant= 1
    w19Atacant = 1
    w20Atacant = 1
    w21Atacant = 1
    w22Atacant = 1
    w23Atacant = 1
    w24Atacant= 1
    w25Atacant = 1
    w26Atacant = 1
    bPortar = 1
    bFundas = 1
    bMijlocas = 1
    bAtacant = 1

    iterations = 1000
    learning_rate = 1
    costs = [] # keep costs during training, see if they go down
    
    for i in range(iterations):
        # get a random point
        ri = np.random.randint(len(train_data))
        point = train_data.values[ri]
        target = point[29]
        if math.isnan(point[25]):
            continue

        if point[0] == "portar":
            z = float(point[4]) * w1Portar + float(point[5]) * w2Portar + float(point[7]) * w3Portar + float(point[8]) * w4Portar + float(point[10]) * w5Portar + float(point[15]) * w6Portar + float(point[25]) * w7Portar + float(point[27]) * w8Portar + bPortar
        if point[0] == "fundas":
            z = float(point[2]) * w1Fundas + float(point[3]) * w2Fundas + float(point[4]) * w3Fundas + float(point[5]) * w4Fundas + float(point[6]) * w5Fundas + float(point[7]) * w6Fundas + float(point[8]) * w7Fundas + float(point[10]) * w8Fundas + float(point[11]) * w9Fundas + float(point[12]) * w10Fundas + float(point[13]) * w11Fundas + float(point[14]) * w12Fundas + float(point[15]) * w13Fundas + float(point[16]) * w14Fundas + float(point[17]) * w15Fundas + float(point[18]) * w16Fundas + float(point[19]) * w17Fundas + float(point[20]) * w18Fundas + float(point[21]) * w19Fundas + float(point[22]) * w20Fundas + float(point[23]) * w21Fundas + float(point[24]) * w22Fundas + float(point[25]) * w23Fundas + float(point[26]) * w24Fundas + float(point[27]) * w25Fundas + float(point[28]) * w26Fundas + bFundas
        if point[0] == "mijlocas":
            z = float(point[2]) * w1Mijlocas + float(point[3]) * w2Mijlocas + float(point[4]) * w3Mijlocas + float(point[5]) * w4Mijlocas + float(point[6]) * w5Mijlocas + float(point[7]) * w6Mijlocas + float(point[8]) * w7Mijlocas + float(point[10]) * w8Mijlocas + float(point[11]) * w9Mijlocas + float(point[12]) * w10Mijlocas + float(point[13]) * w11Mijlocas + float(point[14]) * w12Mijlocas + float(point[15]) * w13Mijlocas + float(point[16]) * w14Mijlocas + float(point[17]) * w15Mijlocas + float(point[18]) * w16Mijlocas + float(point[19]) * w17Mijlocas + float(point[20]) * w18Mijlocas + float(point[21]) * w19Mijlocas + float(point[22]) * w20Mijlocas + float(point[23]) * w21Mijlocas + float(point[24]) * w22Mijlocas + float(point[25]) * w23Mijlocas + float(point[26]) * w24Mijlocas + float(point[27]) * w25Mijlocas + float(point[28]) * w26Mijlocas + bMijlocas
        if point[0] == "atacant":
            z = float(point[2]) * w1Atacant + float(point[3]) * w2Atacant + float(point[4]) * w3Atacant + float(point[5]) * w4Atacant + float(point[6]) * w5Atacant + float(point[7]) * w6Atacant + float(point[8]) * w7Atacant + float(point[10]) * w8Atacant + float(point[11]) * w9Atacant + float(point[12]) * w10Atacant + float(point[13]) * w11Atacant + float(point[14]) * w12Atacant + float(point[15]) * w13Atacant + float(point[16]) * w14Atacant + float(point[17]) * w15Atacant + float(point[18]) * w16Atacant + float(point[19]) * w17Atacant + float(point[20]) * w18Atacant + float(point[21]) * w19Atacant + float(point[22]) * w20Atacant + float(point[23]) * w21Atacant + float(point[24]) * w22Atacant + float(point[25]) * w23Atacant + float(point[26]) * w24Atacant + float(point[27]) * w25Atacant + float(point[28]) * w26Atacant + bAtacant

        pred = sigmoid(z) # networks prediction
        
        # cost for current random point
        cost = np.square(pred - target)
        print(cost)
        
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
        
        if point[0] == "portar":
            dz_dw1 = point[4]
            dz_dw2 = point[5]
            dz_dw3 = point[7]
            dz_dw4 = point[8]
            dz_dw5 = point[10]
            dz_dw6 = point[15]
            dz_dw7 = point[25]
            dz_dw8 = point[27]
            dz_dw9 = 0
            dz_dw10 = 0
            dz_dw11 = 0
            dz_dw12 = 0
            dz_dw13 = 0
            dz_dw14 = 0
            dz_dw15 = 0
            dz_dw16 = 0
            dz_dw17 = 0
            dz_dw18 = 0
            dz_dw19 = 0
            dz_dw20 = 0
            dz_dw21 = 0
            dz_dw22 = 0
            dz_dw23 = 0
            dz_dw24 = 0
            dz_dw25 = 0
            dz_dw26 = 0
        else:
            dz_dw1 = point[2]
            dz_dw2 = point[3]
            dz_dw3 = point[4]
            dz_dw4 = point[5]
            dz_dw5 = point[6]
            dz_dw6 = point[7]
            dz_dw7 = point[8]
            dz_dw8 = point[10]
            dz_dw9 = point[11]
            dz_dw10 = point[12]
            dz_dw11 = point[13]
            dz_dw12 = point[14]
            dz_dw13 = point[15]
            dz_dw14 = point[16]
            dz_dw15 = point[17]
            dz_dw16 = point[18]
            dz_dw17 = point[19]
            dz_dw18 = point[20]
            dz_dw19 = point[21]
            dz_dw20 = point[22]
            dz_dw21 = point[23]
            dz_dw22 = point[24]
            dz_dw23 = point[25]
            dz_dw24 = point[26]
            dz_dw25 = point[27]
            dz_dw26 = point[28]
        
        dcost_dz = dcost_dpred * dpred_dz
        
        dcost_dw1 = dcost_dz * dz_dw1
        dcost_dw2 = dcost_dz * dz_dw2
        dcost_dw3 = dcost_dz * dz_dw3
        dcost_dw4 = dcost_dz * dz_dw4
        dcost_dw5 = dcost_dz * dz_dw5
        dcost_dw6 = dcost_dz * dz_dw6
        dcost_dw7 = dcost_dz * dz_dw7
        dcost_dw8 = dcost_dz * dz_dw8
        dcost_dw9 = dcost_dz * dz_dw9
        dcost_dw10 = dcost_dz * dz_dw10
        dcost_dw11 = dcost_dz * dz_dw11
        dcost_dw12 = dcost_dz * dz_dw12
        dcost_dw13 = dcost_dz * dz_dw13
        dcost_dw14 = dcost_dz * dz_dw14
        dcost_dw15 = dcost_dz * dz_dw15
        dcost_dw16 = dcost_dz * dz_dw16
        dcost_dw17 = dcost_dz * dz_dw17
        dcost_dw18 = dcost_dz * dz_dw18
        dcost_dw19 = dcost_dz * dz_dw19
        dcost_dw20 = dcost_dz * dz_dw20
        dcost_dw21 = dcost_dz * dz_dw21
        dcost_dw22 = dcost_dz * dz_dw22
        dcost_dw23 = dcost_dz * dz_dw23
        dcost_dw24 = dcost_dz * dz_dw24
        dcost_dw25 = dcost_dz * dz_dw25
        dcost_dw26 = dcost_dz * dz_dw26
        dcost_db = dcost_dz
        
        if point[0] == "portar":
            w1Portar = w1Portar - learning_rate * dcost_dw1
            w2Portar = w2Portar - learning_rate * dcost_dw2
            w3Portar = w3Portar - learning_rate * dcost_dw3
            w4Portar = w4Portar - learning_rate * dcost_dw4
            w5Portar = w5Portar - learning_rate * dcost_dw5
            w6Portar = w6Portar - learning_rate * dcost_dw6
            w7Portar = w7Portar - learning_rate * dcost_dw7
            w8Portar = w8Portar - learning_rate * dcost_dw8
            bPortar = bPortar - learning_rate * dcost_db
        if point[0] == "fundas":
            w1Fundas = w1Fundas - learning_rate * dcost_dw1
            w2Fundas = w2Fundas - learning_rate * dcost_dw2
            w3Fundas = w3Fundas - learning_rate * dcost_dw3
            w4Fundas = w4Fundas - learning_rate * dcost_dw4
            w5Fundas = w5Fundas - learning_rate * dcost_dw5
            w6Fundas = w6Fundas - learning_rate * dcost_dw6
            w7Fundas = w7Fundas - learning_rate * dcost_dw7
            w8Fundas = w8Fundas - learning_rate * dcost_dw8
            w9Fundas = w9Fundas - learning_rate * dcost_dw9
            w10Fundas = w10Fundas - learning_rate * dcost_dw10
            w11Fundas = w11Fundas - learning_rate * dcost_dw11
            w12Fundas = w12Fundas - learning_rate * dcost_dw12
            w13Fundas = w13Fundas - learning_rate * dcost_dw13
            w14Fundas = w14Fundas - learning_rate * dcost_dw14
            w15Fundas = w15Fundas - learning_rate * dcost_dw15
            w16Fundas = w16Fundas - learning_rate * dcost_dw16
            w17Fundas = w17Fundas - learning_rate * dcost_dw17
            w18Fundas = w18Fundas - learning_rate * dcost_dw18
            w19Fundas = w19Fundas - learning_rate * dcost_dw19
            w20Fundas = w20Fundas - learning_rate * dcost_dw20
            w21Fundas = w21Fundas - learning_rate * dcost_dw21
            w22Fundas = w22Fundas - learning_rate * dcost_dw22
            w23Fundas = w23Fundas - learning_rate * dcost_dw23
            w24Fundas = w24Fundas - learning_rate * dcost_dw24
            w25Fundas = w25Fundas - learning_rate * dcost_dw25
            w26Fundas = w26Fundas - learning_rate * dcost_dw26
            bFundas = bFundas - learning_rate * dcost_db
        if point[0] == "mijlocas":
            w1Mijlocas = w1Mijlocas - learning_rate * dcost_dw1
            w2Mijlocas = w2Mijlocas - learning_rate * dcost_dw2
            w3Mijlocas = w3Mijlocas - learning_rate * dcost_dw3
            w4Mijlocas = w4Mijlocas - learning_rate * dcost_dw4
            w5Mijlocas = w5Mijlocas - learning_rate * dcost_dw5
            w6Mijlocas = w6Mijlocas - learning_rate * dcost_dw6
            w7Mijlocas = w7Mijlocas - learning_rate * dcost_dw7
            w8Mijlocas = w8Mijlocas - learning_rate * dcost_dw8
            w9Mijlocas = w9Mijlocas - learning_rate * dcost_dw9
            w10Mijlocas = w10Mijlocas - learning_rate * dcost_dw10
            w11Mijlocas = w11Mijlocas - learning_rate * dcost_dw11
            w12Mijlocas = w12Mijlocas - learning_rate * dcost_dw12
            w13Mijlocas = w13Mijlocas - learning_rate * dcost_dw13
            w14Mijlocas = w14Mijlocas - learning_rate * dcost_dw14
            w15Mijlocas = w15Mijlocas - learning_rate * dcost_dw15
            w16Mijlocas = w16Mijlocas - learning_rate * dcost_dw16
            w17Mijlocas = w17Mijlocas - learning_rate * dcost_dw17
            w18Mijlocas = w18Mijlocas - learning_rate * dcost_dw18
            w19Mijlocas = w19Mijlocas - learning_rate * dcost_dw19
            w20Mijlocas = w20Mijlocas - learning_rate * dcost_dw20
            w21Mijlocas = w21Mijlocas - learning_rate * dcost_dw21
            w22Mijlocas = w22Mijlocas - learning_rate * dcost_dw22
            w23Mijlocas = w23Mijlocas - learning_rate * dcost_dw23
            w24Mijlocas = w24Mijlocas - learning_rate * dcost_dw24
            w25Mijlocas = w25Mijlocas - learning_rate * dcost_dw25
            w26Mijlocas = w26Mijlocas - learning_rate * dcost_dw26
            bMijlocas = bMijlocas - learning_rate * dcost_db
        if point[0] == "atacant":
            w1Atacant = w1Atacant - learning_rate * dcost_dw1
            w2Atacant = w2Atacant - learning_rate * dcost_dw2
            w3Atacant = w3Atacant - learning_rate * dcost_dw3
            w4Atacant = w4Atacant - learning_rate * dcost_dw4
            w5Atacant = w5Atacant - learning_rate * dcost_dw5
            w6Atacant = w6Atacant - learning_rate * dcost_dw6
            w7Atacant = w7Atacant - learning_rate * dcost_dw7
            w8Atacant = w8Atacant - learning_rate * dcost_dw8
            w9Atacant = w9Atacant - learning_rate * dcost_dw9
            w10Atacant = w10Atacant - learning_rate * dcost_dw10
            w11Atacant = w11Atacant - learning_rate * dcost_dw11
            w12Atacant = w12Atacant - learning_rate * dcost_dw12
            w13Atacant = w13Atacant - learning_rate * dcost_dw13
            w14Atacant = w14Atacant - learning_rate * dcost_dw14
            w15Atacant = w15Atacant - learning_rate * dcost_dw15
            w16Atacant = w16Atacant - learning_rate * dcost_dw16
            w17Atacant = w17Atacant - learning_rate * dcost_dw17
            w18Atacant = w18Atacant - learning_rate * dcost_dw18
            w19Atacant = w19Atacant - learning_rate * dcost_dw19
            w20Atacant = w20Atacant - learning_rate * dcost_dw20
            w21Atacant = w21Atacant - learning_rate * dcost_dw21
            w22Atacant = w22Atacant - learning_rate * dcost_dw22
            w23Atacant = w23Atacant - learning_rate * dcost_dw23
            w24Atacant = w24Atacant - learning_rate * dcost_dw24
            w25Atacant = w25Atacant - learning_rate * dcost_dw25
            w26Atacant = w26Atacant - learning_rate * dcost_dw26
            bAtacant = bAtacant - learning_rate * dcost_db
        
    return w1Portar, w2Portar, w3Portar, w4Portar, w5Portar, w6Portar, w7Portar, w8Portar, w1Fundas, w2Fundas, w3Fundas, w4Fundas, w5Fundas, w6Fundas, w7Fundas, w8Fundas, w9Fundas, w10Fundas, w11Fundas,\
    w12Fundas, w13Fundas, w14Fundas, w15Fundas, w16Fundas, w17Fundas, w18Fundas, w19Fundas, w20Fundas, w21Fundas, w22Fundas, w23Fundas, w24Fundas, w25Fundas, w26Fundas, w1Mijlocas, w2Mijlocas, w3Mijlocas,\
    w4Mijlocas, w5Mijlocas, w6Mijlocas, w7Mijlocas, w8Mijlocas, w9Mijlocas, w10Mijlocas, w11Mijlocas, w12Mijlocas, w13Mijlocas, w14Mijlocas, w15Mijlocas, w16Mijlocas, w17Mijlocas, w18Mijlocas, w19Mijlocas,\
    w20Mijlocas, w21Mijlocas, w22Mijlocas, w23Mijlocas, w24Mijlocas, w25Mijlocas, w26Mijlocas, w1Atacant, w2Atacant, w3Atacant, w4Atacant, w5Atacant, w6Atacant, w7Atacant, w8Atacant, w9Atacant, w10Atacant, w11Atacant,\
    w12Atacant, w13Atacant, w14Atacant, w15Atacant, w16Atacant, w17Atacant, w18Atacant, w19Atacant, w20Atacant, w21Atacant, w22Atacant, w23Atacant, w24Atacant, w25Atacant, w26Atacant, bPortar, bFundas, bMijlocas, bAtacant
        
w1Portar, w2Portar, w3Portar, w4Portar, w5Portar, w6Portar, w7Portar, w8Portar, w1Fundas, w2Fundas, w3Fundas, w4Fundas, w5Fundas, w6Fundas, w7Fundas, w8Fundas, w9Fundas, w10Fundas, w11Fundas, w12Fundas, w13Fundas,\
w14Fundas, w15Fundas, w16Fundas, w17Fundas, w18Fundas, w19Fundas, w20Fundas, w21Fundas, w22Fundas, w23Fundas, w24Fundas, w25Fundas, w26Fundas, w1Mijlocas, w2Mijlocas, w3Mijlocas, w4Mijlocas, w5Mijlocas, w6Mijlocas,\
w7Mijlocas, w8Mijlocas, w9Mijlocas, w10Mijlocas, w11Mijlocas, w12Mijlocas, w13Mijlocas, w14Mijlocas, w15Mijlocas, w16Mijlocas, w17Mijlocas, w18Mijlocas, w19Mijlocas, w20Mijlocas, w21Mijlocas, w22Mijlocas, w23Mijlocas,\
w24Mijlocas, w25Mijlocas, w26Mijlocas, w1Atacant, w2Atacant, w3Atacant, w4Atacant, w5Atacant, w6Atacant, w7Atacant, w8Atacant, w9Atacant, w10Atacant, w11Atacant, w12Atacant, w13Atacant, w14Atacant, w15Atacant, w16Atacant,\
w17Atacant, w18Atacant, w19Atacant, w20Atacant, w21Atacant, w22Atacant, w23Atacant, w24Atacant, w25Atacant, w26Atacant, bPortar, bFundas, bMijlocas, bAtacant = train()

f = open("weights.txt", "w")
f.write(repr(w1Portar)+" "+ repr(w2Portar)+" "+ repr(w3Portar)+" "+ repr(w4Portar)+" "+ repr(w5Portar)+" "+ repr(w6Portar)+" "+ repr(w7Portar)+" "+ repr(w8Portar)+" "+ repr(w1Fundas)+" "+ repr(w2Fundas)+" "+ repr(w3Fundas)+" "+ repr(w4Fundas)+" "+ repr(w5Fundas)\
+" "+ repr(w6Fundas)+" "+ repr(w7Fundas)+" "+ repr(w8Fundas)+" "+ repr(w9Fundas)+" "+ repr(w10Fundas)+" "+ repr(w11Fundas)+" "+ repr(w12Fundas)+" "+ repr(w13Fundas)+" "+ repr(w14Fundas)+" "+ repr(w15Fundas)+" "+ repr(w16Fundas)+" "+ repr(w17Fundas)+" "+ repr(w18Fundas)+" "+ repr(w19Fundas)+" "+ repr(w20Fundas)+" "+ repr(w21Fundas)+" "+ repr(w22Fundas)+" "+ repr(w23Fundas)+" "+ repr(w24Fundas)+" "+ repr(w25Fundas)+" "+ repr(w26Fundas)\
+" "+ repr(w1Mijlocas)+" "+ repr(w2Mijlocas)+" "+ repr(w3Mijlocas)+" "+ repr(w4Mijlocas)+" "+ repr(w5Mijlocas)+" "+ repr(w6Mijlocas)+" "+ repr(w7Mijlocas)+" "+ repr(w8Mijlocas)+" "+ repr(w9Mijlocas)+" "+ repr(w10Mijlocas)+" "+ repr(w11Mijlocas)+" "+ repr(w12Mijlocas)+" "+ repr(w13Mijlocas)\
+" "+ repr(w14Mijlocas)+" "+ repr(w15Mijlocas)+" "+ repr(w16Mijlocas)+" "+ repr(w17Mijlocas)+" "+ repr(w18Mijlocas)+" "+ repr(w19Mijlocas)+" "+ repr(w20Mijlocas)+" "+ repr(w21Mijlocas)+" "+ repr(w22Mijlocas)+" "+ repr(w23Mijlocas)+" "+ repr(w24Mijlocas)+" "+ repr(w25Mijlocas)+" "+ repr(w26Mijlocas)+" "+ repr(w1Atacant)\
+" "+ repr(w2Atacant)+" "+ repr(w3Atacant)+" "+ repr(w4Atacant)+" "+ repr(w5Atacant)+" "+ repr(w6Atacant)+" "+ repr(w7Atacant)+" "+ repr(w8Atacant)+" "+ repr(w9Atacant)+" "+ repr(w10Atacant)+" "+ repr(w11Atacant)+" "+ repr(w12Atacant)+" "+ repr(w13Atacant)+" "+ repr(w14Atacant)+" "+ repr(w15Atacant)\
+" "+ repr(w16Atacant)+" "+ repr(w17Atacant)+" "+ repr(w18Atacant)+" "+ repr(w19Atacant)+" "+ repr(w20Atacant)+" "+ repr(w21Atacant)+" "+ repr(w22Atacant)+" "+ repr(w23Atacant)+" "+ repr(w24Atacant)+" "+ repr(w25Atacant)+" "+ repr(w26Atacant)+" "+ repr(bPortar)+" "+ repr(bFundas)+" "+ repr(bMijlocas)+" "+ repr(bAtacant))
f.close()
