import numpy as np
import pandas as pd
import matplotlib.pyplot as plt

df=pd.read_csv('/content/water_analysis.csv')


df.head(20)

df.isnull().sum()

#independent variable
x=df.drop('nutrition_values',axis=1)

#dependent variable
y=df['nutrition_values']


from sklearn.preprocessing import LabelEncoder
le=LabelEncoder()
y=le.fit_transform(y)


from sklearn.model_selection import train_test_split
x_train,x_test,y_train,y_test=train_test_split(x,y,test_size=0.25,random_state=0)

from sklearn.preprocessing import StandardScaler
ss=StandardScaler()
x_train=ss.fit_transform(x_train)
x_test=ss.transform(x_test)

from sklearn.linear_model import LogisticRegression
from sklearn.metrics import accuracy_score,confusion_matrix

log=LogisticRegression()#default is 100
log.fit(x_train,y_train)
pred=log.predict(x_test)

accuracy=accuracy_score(y_test,pred)
accuracy

from sklearn.svm import SVC

model=SVC(kernel='linear',random_state=0)
#model=svm.SVC()
model.fit(x_train,y_train)
print(model)
pred=model.predict(x_test)
acc=accuracy_score(y_test,pred)
print(pred)
print(y_test)
print(acc)

#input_data=(7.687538,1.232092,21.122370,50.374243,0.148333)
input_data=(7,	0.2,	30,	40,	0.4)
input_data_nparray=np.asarray(input_data)
reshape_data =input_data_nparray.reshape(1,-1)
prediction=log.predict(reshape_data)
if prediction==1:
  print('the crop has normal')
else:
  print('the crop has high')

