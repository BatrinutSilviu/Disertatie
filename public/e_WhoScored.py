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
w7Portar = float(weights[6])
w8Portar = float(weights[7])
w1Fundas = float(weights[8])
w2Fundas = float(weights[9])
w3Fundas = float(weights[10])
w4Fundas = float(weights[11])
w5Fundas = float(weights[12])
w6Fundas = float(weights[13])
w7Fundas = float(weights[14])
w8Fundas = float(weights[15])
w9Fundas = float(weights[16])
w10Fundas = float(weights[17])
w11Fundas = float(weights[18])
w12Fundas = float(weights[19])
w13Fundas = float(weights[20])
w14Fundas = float(weights[21])
w15Fundas = float(weights[22])
w16Fundas = float(weights[23])
w17Fundas = float(weights[24])
w18Fundas = float(weights[25])
w19Fundas = float(weights[26])
w20Fundas = float(weights[27])
w21Fundas = float(weights[28])
w22Fundas = float(weights[29])
w23Fundas = float(weights[30])
w24Fundas = float(weights[31])
w25Fundas = float(weights[32])
w26Fundas = float(weights[33])
w1Mijlocas = float(weights[34])
w2Mijlocas = float(weights[35])
w3Mijlocas = float(weights[36])
w4Mijlocas = float(weights[37])
w5Mijlocas = float(weights[38])
w6Mijlocas = float(weights[39])
w7Mijlocas = float(weights[40])
w8Mijlocas = float(weights[41])
w9Mijlocas = float(weights[42])
w10Mijlocas = float(weights[43])
w11Mijlocas = float(weights[44])
w12Mijlocas = float(weights[45])
w13Mijlocas = float(weights[46])
w14Mijlocas = float(weights[47])
w15Mijlocas = float(weights[48])
w16Mijlocas = float(weights[49])
w17Mijlocas = float(weights[50])
w18Mijlocas = float(weights[51])
w19Mijlocas = float(weights[52])
w20Mijlocas = float(weights[53])
w21Mijlocas = float(weights[54])
w22Mijlocas = float(weights[55])
w23Mijlocas = float(weights[56])
w24Mijlocas = float(weights[57])
w25Mijlocas = float(weights[58])
w26Mijlocas = float(weights[59])
w1Atacant = float(weights[60])
w2Atacant = float(weights[61])
w3Atacant = float(weights[62])
w4Atacant = float(weights[63])
w5Atacant = float(weights[64])
w6Atacant = float(weights[65])
w7Atacant = float(weights[66])
w8Atacant = float(weights[67])
w9Atacant = float(weights[68])
w10Atacant = float(weights[69])
w11Atacant = float(weights[70])
w12Atacant = float(weights[71])
w13Atacant = float(weights[72])
w14Atacant = float(weights[73])
w15Atacant = float(weights[74])
w16Atacant = float(weights[75])
w17Atacant = float(weights[76])
w18Atacant = float(weights[77])
w19Atacant = float(weights[78])
w20Atacant = float(weights[79])
w21Atacant = float(weights[80])
w22Atacant = float(weights[81])
w23Atacant = float(weights[82])
w24Atacant = float(weights[83])
w25Atacant = float(weights[84])
w26Atacant = float(weights[85])
bPortar = float(weights[86])
bFundas = float(weights[87])
bMijlocas = float(weights[88])
bAtacant = float(weights[89])
post = str(sys.argv[1])

if post == "portar":
    z = float(sys.argv[2]) * w1Portar + float(sys.argv[3]) * w2Portar + float(sys.argv[4]) * w3Portar + float(sys.argv[5]) * w4Portar + float(sys.argv[6]) * w5Portar + float(sys.argv[7]) * w6Portar + float(sys.argv[8]) * w7Portar + float(sys.argv[9]) * w8Portar + bPortar
if post == "fundas":
    z = float(sys.argv[2]) * w1Fundas + float(sys.argv[3]) * w2Fundas + float(sys.argv[4]) * w3Fundas + float(sys.argv[5]) * w4Fundas + float(sys.argv[6]) * w5Fundas + float(sys.argv[7]) * w6Fundas + float(sys.argv[8]) * w7Fundas + float(sys.argv[9]) * w8Fundas + float(sys.argv[10]) * w9Fundas + float(sys.argv[11]) * w10Fundas + float(sys.argv[12]) * w11Fundas + float(sys.argv[13]) * w12Fundas + float(sys.argv[14]) * w13Fundas + float(sys.argv[15]) * w14Fundas + float(sys.argv[16]) * w15Fundas + float(sys.argv[17]) * w16Fundas + float(sys.argv[18]) * w17Fundas + float(sys.argv[19]) * w18Fundas + float(sys.argv[20]) * w19Fundas + float(sys.argv[21]) * w20Fundas + float(sys.argv[22]) * w21Fundas + float(sys.argv[23]) * w22Fundas + float(sys.argv[24]) * w23Fundas + float(sys.argv[25]) * w24Fundas + float(sys.argv[26]) * w25Fundas + float(sys.argv[27]) * w26Fundas + bFundas
if post == "mijlocas":
    z = float(sys.argv[2]) * w1Mijlocas + float(sys.argv[3]) * w2Mijlocas + float(sys.argv[4]) * w3Mijlocas + float(sys.argv[5]) * w4Mijlocas + float(sys.argv[6]) * w5Mijlocas + float(sys.argv[7]) * w6Mijlocas + float(sys.argv[8]) * w7Mijlocas + float(sys.argv[9]) * w8Mijlocas + float(sys.argv[10]) * w9Mijlocas + float(sys.argv[11]) * w10Mijlocas + float(sys.argv[12]) * w11Mijlocas + float(sys.argv[13]) * w12Mijlocas + float(sys.argv[14]) * w13Mijlocas + float(sys.argv[15]) * w14Mijlocas + float(sys.argv[16]) * w15Mijlocas + float(sys.argv[17]) * w16Mijlocas + float(sys.argv[18]) * w17Mijlocas + float(sys.argv[19]) * w18Mijlocas + float(sys.argv[20]) * w19Mijlocas + float(sys.argv[21]) * w20Mijlocas + float(sys.argv[22]) * w21Mijlocas + float(sys.argv[23]) * w22Mijlocas + float(sys.argv[24]) * w23Mijlocas + float(sys.argv[25]) * w24Mijlocas + float(sys.argv[26]) * w25Mijlocas + float(sys.argv[27]) * w26Mijlocas + bMijlocas
if post == "atacant":
    z = float(sys.argv[2]) * w1Atacant + float(sys.argv[3]) * w2Atacant + float(sys.argv[4]) * w3Atacant + float(sys.argv[5]) * w4Atacant + float(sys.argv[6]) * w5Atacant + float(sys.argv[7]) * w6Atacant + float(sys.argv[8]) * w7Atacant + float(sys.argv[9]) * w8Atacant + float(sys.argv[10]) * w9Atacant + float(sys.argv[11]) * w10Atacant + float(sys.argv[12]) * w11Atacant + float(sys.argv[13]) * w12Atacant + float(sys.argv[14]) * w13Atacant + float(sys.argv[15]) * w14Atacant + float(sys.argv[16]) * w15Atacant + float(sys.argv[17]) * w16Atacant + float(sys.argv[18]) * w17Atacant + float(sys.argv[19]) * w18Atacant + float(sys.argv[20]) * w19Atacant + float(sys.argv[21]) * w20Atacant + float(sys.argv[22]) * w21Atacant + float(sys.argv[23]) * w22Atacant + float(sys.argv[24]) * w23Atacant + float(sys.argv[25]) * w24Atacant + float(sys.argv[26]) * w25Atacant + float(sys.argv[27]) * w26Atacant + bAtacant

pred = sigmoid(z)
print(pred)
file.close()