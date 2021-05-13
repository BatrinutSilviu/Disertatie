import pandas as pd
import numpy as np
import math

          # 0   1       2       3                   4           5               6               7       8       9           10              11      12              13      14                  15              16          17          18                  19      20                          21                          22      23          24                      25                      26              27                  28          29              30          31                      32                  33      34                  35                  36  
col_list=["id","nume","post","iesiri_din_poarta","plonjari","goluri_primite","minute_jucate","boxari","parade","pase_gol","sanse_create","goluri","precizie_pase","suturi","suturi_blocate","precizie_suturi","centrari","pase_cheie","mingi_profunzime","pase","dueluri_aeriene_pierdute","dueluri_aeriene_castigate","degajari","deposedat","driblinguri_incercate","driblinguri_reusite","dueluri_pierdute","dueluri_castigate","faulturi","interceptii","recuperari","deposedari_incercate","deposedari_reusite","faultat","cartonase_galbene","cartonase_rosii","rating"]
train_data = pd.read_csv("DateMLPregatite.csv")#low_memory=False , usecols=col_list
col_list_portar=["iesiri_din_poarta","plonjari","goluri_primite","minute_jucate","boxari","parade","cartonase_galbene","cartonase_rosii","rating"]
#pt portar trebe 7 weights
#pt fundas trebe 18 weights ( goluri, precizie_pase, mingi_profunzime, pase, dap, dac, degajari, dp, dc, faulturi, interceptii, recuperari, di, dr, galben, rosu, deposedat, centrari)
#pt mijlocas trebe 25 weights ( pase_gol, sanse_create, goluri, precizie_pase, suturi, suturi_blocate, precizie_suturi, centrari, pase_cheie, mingi_profunzime, pase, degajari, deposedat, di, dr, dp, dc, faulturi, interceptii, recuperari, di, dr, faultat, galben, rosu)
#pt atacant trebe 22 weights (pase_gol, sanse_create, goluri, precizie_pase, suturi, suturi_blocate, precizie_suturi, centrari, pase_cheie, mingi_profunzime, pase, dap, dac, deposedat, di, dr, dp, dc, faulturi, faultat, galben, rosu)

def sigmoid(x):
    # sig = 1 / (1 + math.exp(-x))     # Define sigmoid function
    # sig = np.minimum(sig, 0.9999)  # Set upper bound
    # sig = np.maximum(sig, 0.0001)  # Set lower bound
    # return sig
    #return 1/(1+np.exp(-x))
    #return x

    return max(0.0, x)

def sigmoid_p(x):
    #return sigmoid(x) * (1-sigmoid(x))
    #return 1
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
    w18Mijlocas = 1
    w19Mijlocas = 1
    w20Mijlocas = 1
    w21Mijlocas = 1
    w22Mijlocas = 1
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
    w18Atacant = 1
    w19Atacant = 1
    bPortar = 1
    bFundas = 1
    bMijlocas = 1
    bAtacant = 1
    
    iterations = 20000 #aici era 10000
    learning_rate = 0.001
    
    for i in range(iterations):
        ri = np.random.randint(len(train_data))
        point = train_data.values[ri]
        target = point[36]
        if math.isnan(target):
            continue
        point[12] = float(point[12]/100)
        point[15] = float(point[15]/100)
        if (point[20] + point[21]) > 0:
            point[20] = point[21]/float((point[20] + point[21]))
        if (point[24]) > 0:
            point[24] = point[25]/float(point[24])
        if (point[26] + point[27]) > 0:
            point[26] = point[27]/float((point[26] + point[27]))
        if (point[31]) > 0:
            point[31] = point[32]/float(point[31])
        for j in range(3,36):
            if j != 6 and j != 12 and j != 15 and j != 20 and j != 24 and j != 26 and j != 31:
                point[j] = point[j]/float(point[6])
        if point[2] == "portar":
            if math.isnan(point[34]):
                point[34] = 0
            if math.isnan(point[35]):
                point[35] = 0
            z = float(point[4]) * w1Portar + float(point[5]) * w2Portar + float(point[7]) * w3Portar + float(point[8]) * w4Portar + float(point[34]) * w5Portar + float(point[35]) * w6Portar + bPortar
        if point[2] == "fundas":
            if math.isnan(point[34]):
                point[34] = 0
            if math.isnan(point[35]):
                point[35] = 0
            z = float(point[23]) * w1Fundas + float(point[11]) * w2Fundas + float(point[12]) * w3Fundas + float(point[18]) * w4Fundas + float(point[19]) * w5Fundas + float(point[20]) * w6Fundas + float(point[22]) * w7Fundas + float(point[26]) * w8Fundas + float(point[28]) * w9Fundas + float(point[29]) * w10Fundas + float(point[30]) * w11Fundas + float(point[31]) * w12Fundas + float(point[34]) * w13Fundas + float(point[35]) * w14Fundas + float(point[16]) * w15Fundas + bFundas
        if point[2] == "mijlocas":
            if math.isnan(point[34]):
                point[34] = 0
            if math.isnan(point[35]):
                point[35] = 0
            z = float(point[35]) * w1Mijlocas + float(point[9]) * w2Mijlocas + float(point[10]) * w3Mijlocas + float(point[11]) * w4Mijlocas + float(point[12]) * w5Mijlocas + float(point[13]) * w6Mijlocas + float(point[14]) * w7Mijlocas + float(point[15]) * w8Mijlocas + float(point[16]) * w9Mijlocas + float(point[17]) * w10Mijlocas + float(point[18]) * w11Mijlocas + float(point[19]) * w12Mijlocas + float(point[22]) * w13Mijlocas + float(point[23]) * w14Mijlocas + float(point[24]) * w15Mijlocas + float(point[26]) * w16Mijlocas + float(point[28]) * w17Mijlocas + float(point[29]) * w18Mijlocas + float(point[30]) * w19Mijlocas + float(point[31]) * w20Mijlocas + float(point[33]) * w21Mijlocas + float(point[34]) * w22Mijlocas + bMijlocas
        if point[2] == "atacant":
            if math.isnan(point[34]):
                point[34] = 0
            if math.isnan(point[35]):
                point[35] = 0
            z = float(point[9]) * w1Atacant + float(point[10]) * w2Atacant + float(point[11]) * w3Atacant + float(point[12]) * w4Atacant + float(point[13]) * w5Atacant + float(point[14]) * w6Atacant + float(point[15]) * w7Atacant + float(point[16]) * w8Atacant + float(point[17]) * w9Atacant + float(point[18]) * w10Atacant + float(point[19]) * w11Atacant + float(point[20]) * w12Atacant + float(point[23]) * w13Atacant + float(point[24]) * w14Atacant + float(point[26]) * w15Atacant + float(point[28]) * w16Atacant + float(point[33]) * w17Atacant + float(point[34]) * w18Atacant + float(point[35]) * w19Atacant + bAtacant
            
        pred = sigmoid(z)
        
        cost = np.square(pred - target)
  
        dcost_dpred = 2 * (pred - target)
        dpred_dz = sigmoid_p(z)
        
        if point[2] == "portar":
            #print("portar")
            dz_dw1 = point[4]
            dz_dw2 = point[5]
            dz_dw3 = point[7]
            dz_dw4 = point[8]
            dz_dw5 = point[34]
            dz_dw6 = point[35]
            dz_dw7 = 0
            dz_dw8 = 0
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
        if point[2] == "fundas":
            #print("fundas")
            dz_dw1 = point[23]
            dz_dw2 = point[11]
            dz_dw3 = point[12]
            dz_dw4 = point[18]
            dz_dw5 = point[19]
            dz_dw6 = point[20]
            dz_dw7 = point[22]
            dz_dw8 = point[26]
            dz_dw9 = point[28]
            dz_dw10 = point[29]
            dz_dw11 = point[30]
            dz_dw12 = point[31]
            dz_dw13 = point[34]
            dz_dw14 = point[35]
            dz_dw15 = point[16]
            dz_dw16 = 0
            dz_dw17 = 0
            dz_dw18 = 0
            dz_dw19 = 0
            dz_dw20 = 0
            dz_dw21 = 0
            dz_dw22 = 0
        if point[2] == "mijlocas":
            #print("mijlocas")
            dz_dw1 = point[35]
            dz_dw2 = point[9]
            dz_dw3 = point[10]
            dz_dw4 = point[11]
            dz_dw5 = point[12]
            dz_dw6 = point[13]
            dz_dw7 = point[14]
            dz_dw8 = point[15]
            dz_dw9 = point[16]
            dz_dw10 = point[17]
            dz_dw11 = point[18]
            dz_dw12 = point[19]
            dz_dw13 = point[22]
            dz_dw14 = point[23]
            dz_dw15 = point[24]
            dz_dw16 = point[26]
            dz_dw17 = point[28]
            dz_dw18 = point[29]
            dz_dw19 = point[30]
            dz_dw20 = point[31]
            dz_dw21 = point[33]
            dz_dw22 = point[34]
            print(str(dz_dw1)+" "+str(dz_dw2)+" "+str(dz_dw3)+" "+str(dz_dw4)+" "+str(dz_dw5)+" "+str(dz_dw6)+" "+str(dz_dw7)+" "+str(dz_dw8)+" "+str(dz_dw9)+" "+str(dz_dw10)+" "+str(dz_dw11)+" "+str(dz_dw12)+" "+str(dz_dw13)+" "+str(dz_dw14)+" "+str(dz_dw15)+" "+str(dz_dw16)+" "+str(dz_dw17)+" "+str(dz_dw18)+" "+str(dz_dw19)+" "+str(dz_dw20)+" "+str(dz_dw21)+" "+str(dz_dw22))
        if point[2] == "atacant":
            #print("atacant")
            dz_dw1 = point[9]
            dz_dw2 = point[10]
            dz_dw3 = point[11]
            dz_dw4 = point[12]
            dz_dw5 = point[13]
            dz_dw6 = point[14]
            dz_dw7 = point[15]
            dz_dw8 = point[16]
            dz_dw9 = point[17]
            dz_dw10 = point[18]
            dz_dw11 = point[19]
            dz_dw12 = point[20]
            dz_dw13 = point[23]
            dz_dw14 = point[24]
            dz_dw15 = point[26]
            dz_dw16 = point[28]
            dz_dw17 = point[33]
            dz_dw18 = point[34]
            dz_dw19 = point[35]
            dz_dw20 = 0
            dz_dw21 = 0
            dz_dw22 = 0
            
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
        dcost_db = dcost_dz
        
        if point[2] == "portar":
            w1Portar = w1Portar - learning_rate * dcost_dw1
            w2Portar = w2Portar - learning_rate * dcost_dw2
            w3Portar = w3Portar - learning_rate * dcost_dw3
            w4Portar = w4Portar - learning_rate * dcost_dw4
            w5Portar = w5Portar - learning_rate * dcost_dw5
            w6Portar = w6Portar - learning_rate * dcost_dw6
            bPortar = bPortar - learning_rate * dcost_db
        if point[2] == "fundas":
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
            bFundas = bFundas - learning_rate * dcost_db
        if point[2] == "mijlocas":
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
            bMijlocas = bMijlocas - learning_rate * dcost_db
        if point[2] == "atacant":
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
            bAtacant = bAtacant - learning_rate * dcost_db
            
    return w1Portar, w2Portar, w3Portar, w4Portar, w5Portar, w6Portar, w1Fundas, w2Fundas, w3Fundas, w4Fundas, w5Fundas, w6Fundas, w7Fundas, w8Fundas, w9Fundas, w10Fundas, w11Fundas,\
    w12Fundas, w13Fundas, w14Fundas, w15Fundas, w1Mijlocas, w2Mijlocas, w3Mijlocas, w4Mijlocas, w5Mijlocas, w6Mijlocas, w7Mijlocas, w8Mijlocas, w9Mijlocas, w10Mijlocas,\
    w11Mijlocas, w12Mijlocas, w13Mijlocas, w14Mijlocas, w15Mijlocas, w16Mijlocas, w17Mijlocas, w18Mijlocas, w19Mijlocas, w20Mijlocas, w21Mijlocas, w22Mijlocas,\
    w1Atacant, w2Atacant, w3Atacant, w4Atacant, w5Atacant, w6Atacant, w7Atacant, w8Atacant, w9Atacant, w10Atacant, w11Atacant, w12Atacant, w13Atacant, w14Atacant, w15Atacant, w16Atacant, w17Atacant,\
    w18Atacant, w19Atacant, bPortar, bFundas, bMijlocas, bAtacant
        
w1Portar, w2Portar, w3Portar, w4Portar, w5Portar, w6Portar, w1Fundas, w2Fundas, w3Fundas, w4Fundas, w5Fundas, w6Fundas, w7Fundas, w8Fundas, w9Fundas, w10Fundas, w11Fundas, w12Fundas, w13Fundas,\
 w14Fundas, w15Fundas, w1Mijlocas, w2Mijlocas, w3Mijlocas, w4Mijlocas, w5Mijlocas, w6Mijlocas, w7Mijlocas, w8Mijlocas, w9Mijlocas, w10Mijlocas, w11Mijlocas, w12Mijlocas,\
 w13Mijlocas, w14Mijlocas, w15Mijlocas, w16Mijlocas, w17Mijlocas, w18Mijlocas, w19Mijlocas, w20Mijlocas, w21Mijlocas, w22Mijlocas, w1Atacant, w2Atacant, w3Atacant,\
 w4Atacant, w5Atacant, w6Atacant, w7Atacant, w8Atacant, w9Atacant, w10Atacant, w11Atacant, w12Atacant, w13Atacant, w14Atacant, w15Atacant, w16Atacant, w17Atacant, w18Atacant, w19Atacant,\
 bPortar, bFundas, bMijlocas, bAtacant = train()

f = open("weights.txt", "w")
f.write(repr(w1Portar)+" "+ repr(w2Portar)+" "+ repr(w3Portar)+" "+ repr(w4Portar)+" "+ repr(w5Portar)+" "+ repr(w6Portar)+" "+ repr(w1Fundas)+" "+ repr(w2Fundas)+" "+ repr(w3Fundas)+" "+ repr(w4Fundas)+" "+ repr(w5Fundas)\
+" "+ repr(w6Fundas)+" "+ repr(w7Fundas)+" "+ repr(w8Fundas)+" "+ repr(w9Fundas)+" "+ repr(w10Fundas)+" "+ repr(w11Fundas)+" "+ repr(w12Fundas)+" "+ repr(w13Fundas)+" "+ repr(w14Fundas)+" "+ repr(w15Fundas)\
+" "+ repr(w1Mijlocas)+" "+ repr(w2Mijlocas)+" "+ repr(w3Mijlocas)+" "+ repr(w4Mijlocas)+" "+ repr(w5Mijlocas)+" "+ repr(w6Mijlocas)+" "+ repr(w7Mijlocas)+" "+ repr(w8Mijlocas)+" "+ repr(w9Mijlocas)+" "+ repr(w10Mijlocas)+" "+ repr(w11Mijlocas)+" "+ repr(w12Mijlocas)+" "+ repr(w13Mijlocas)\
+" "+ repr(w14Mijlocas)+" "+ repr(w15Mijlocas)+" "+ repr(w16Mijlocas)+" "+ repr(w17Mijlocas)+" "+ repr(w18Mijlocas)+" "+ repr(w19Mijlocas)+" "+ repr(w20Mijlocas)+" "+ repr(w21Mijlocas)+" "+ repr(w22Mijlocas)+" "+ repr(w1Atacant)\
+" "+ repr(w2Atacant)+" "+ repr(w3Atacant)+" "+ repr(w4Atacant)+" "+ repr(w5Atacant)+" "+ repr(w6Atacant)+" "+ repr(w7Atacant)+" "+ repr(w8Atacant)+" "+ repr(w9Atacant)+" "+ repr(w10Atacant)+" "+ repr(w11Atacant)+" "+ repr(w12Atacant)+" "+ repr(w13Atacant)+" "+ repr(w14Atacant)+" "+ repr(w15Atacant)\
+" "+ repr(w16Atacant)+" "+ repr(w17Atacant)+" "+ repr(w18Atacant)+" "+ repr(w19Atacant)+" "+ repr(bPortar)+" "+ repr(bFundas)+" "+ repr(bMijlocas)+" "+ repr(bAtacant))
f.close()

