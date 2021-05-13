import sys
import math

def sigmoid(x):
    #return 1/(1+math.exp(-x))
    return max(0.0, x)

file = open("weights.txt", "r")
weights = file.read().split()
w1Portar = float(weights[0])
w2Portar = float(weights[1])
w3Portar = float(weights[2])
w4Portar = float(weights[3])
w5Portar = float(weights[4])
w6Portar = float(weights[5])
w1Fundas = float(weights[6])
w2Fundas = float(weights[7])
w3Fundas = float(weights[8])
w4Fundas = float(weights[9])
w5Fundas = float(weights[10])
w6Fundas = float(weights[11])
w7Fundas = float(weights[12])
w8Fundas = float(weights[13])
w9Fundas = float(weights[14])
w10Fundas = float(weights[15])
w11Fundas = float(weights[16])
w12Fundas = float(weights[17])
w13Fundas = float(weights[18])
w14Fundas = float(weights[19])
w1Mijlocas = float(weights[20])
w2Mijlocas = float(weights[21])
w3Mijlocas = float(weights[22])
w4Mijlocas = float(weights[23])
w5Mijlocas = float(weights[24])
w6Mijlocas = float(weights[25])
w7Mijlocas = float(weights[26])
w8Mijlocas = float(weights[27])
w9Mijlocas = float(weights[28])
w10Mijlocas = float(weights[29])
w11Mijlocas = float(weights[30])
w12Mijlocas = float(weights[31])
w13Mijlocas = float(weights[32])
w14Mijlocas = float(weights[33])
w15Mijlocas = float(weights[34])
w16Mijlocas = float(weights[35])
w17Mijlocas = float(weights[36])
w18Mijlocas = float(weights[37])
w19Mijlocas = float(weights[38])
w20Mijlocas = float(weights[39])
w1Atacant = float(weights[40])
w2Atacant = float(weights[41])
w3Atacant = float(weights[42])
w4Atacant = float(weights[43])
w5Atacant = float(weights[44])
w6Atacant = float(weights[45])
w7Atacant = float(weights[46])
w8Atacant = float(weights[47])
w9Atacant = float(weights[48])
w10Atacant = float(weights[49])
w11Atacant = float(weights[50])
w12Atacant = float(weights[51])
w13Atacant = float(weights[52])
w14Atacant = float(weights[53])
w15Atacant = float(weights[54])
w16Atacant = float(weights[55])
w17Atacant = float(weights[56])
#bPortar = float(weights[57])
#bFundas = float(weights[58])
#bMijlocas = float(weights[59])
#bAtacant = float(weights[60])

post = str(sys.argv[1])
minute_jucate = float(sys.argv[5])

sys.argv[11] = float(sys.argv[11])/100
sys.argv[14] = float(sys.argv[14])/100
for i in range(2, 35):
    if i != 11 and i != 14 and i != 5:
        sys.argv[i] = float(sys.argv[i])/minute_jucate

if post == "atacant":
    z =  float(sys.argv[8]) * w1Atacant + float(sys.argv[9]) * w2Atacant + float(sys.argv[10]) * w3Atacant + float(sys.argv[12]) * w4Atacant + float(sys.argv[13]) * w5Atacant + float(sys.argv[15]) * w6Atacant + float(sys.argv[16]) * w7Atacant + float(sys.argv[17]) * w8Atacant + float(sys.argv[18]) * w9Atacant + float(sys.argv[19]) * w10Atacant + float(sys.argv[22]) * w11Atacant + float(sys.argv[23]) * w12Atacant + float(sys.argv[25]) * w13Atacant + float(sys.argv[27]) * w14Atacant + float(sys.argv[32]) * w15Atacant + float(sys.argv[33]) * w16Atacant + float(sys.argv[34]) * w17Atacant# + bAtacant
if post == "mijlocas":
    z =  float(sys.argv[34]) * w1Mijlocas + float(sys.argv[8]) * w2Mijlocas + float(sys.argv[9]) * w3Mijlocas + float(sys.argv[10]) * w4Mijlocas + float(sys.argv[12]) * w5Mijlocas + float(sys.argv[13]) * w6Mijlocas + float(sys.argv[15]) * w7Mijlocas + float(sys.argv[16]) * w8Mijlocas + float(sys.argv[17]) * w9Mijlocas + float(sys.argv[18]) * w10Mijlocas + float(sys.argv[21]) * w11Mijlocas + float(sys.argv[22]) * w12Mijlocas + float(sys.argv[23]) * w13Mijlocas + float(sys.argv[25]) * w14Mijlocas + float(sys.argv[27]) * w15Mijlocas + float(sys.argv[28]) * w16Mijlocas + float(sys.argv[29]) * w17Mijlocas + float(sys.argv[30]) * w18Mijlocas + float(sys.argv[32]) * w19Mijlocas + float(sys.argv[33]) * w20Mijlocas# + bMijlocas
if post == "fundas":
    z =  float(sys.argv[22]) * w1Fundas + float(sys.argv[10]) * w2Fundas + float(sys.argv[17]) * w3Fundas + float(sys.argv[18]) * w4Fundas + float(sys.argv[19]) * w5Fundas + float(sys.argv[21]) * w6Fundas + float(sys.argv[25]) * w7Fundas + float(sys.argv[27]) * w8Fundas + float(sys.argv[28]) * w9Fundas + float(sys.argv[29]) * w10Fundas + float(sys.argv[30]) * w11Fundas + float(sys.argv[33]) * w12Fundas + float(sys.argv[34]) * w13Fundas + float(sys.argv[15]) * w14Fundas# + bFundas
if post == "portar":
    z =  float(sys.argv[3]) * w1Portar + float(sys.argv[4]) * w2Portar + float(sys.argv[6]) * w3Portar + float(sys.argv[7]) * w4Portar + float(sys.argv[33]) * w5Portar + float(sys.argv[34]) * w6Portar# + bPortar
pred = sigmoid(z)
print(int(pred*10))
file.close()