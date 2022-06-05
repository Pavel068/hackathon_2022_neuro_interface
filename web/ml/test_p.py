import pandas as pd
import os
import tabula

import warnings
warnings.filterwarnings("ignore")

df = pd.read_csv('Дата-сет для задачи №1/Дата-сет_Задача 1.csv',encoding = 'cp1251',sep = ';')
df_file = df[df['Наименование_файла_с_описанием']==df['Наименование_файла_с_описанием']]
import fitz # install using: pip install PyMuPDF
def get_first_page_from_pdf(fname):
    with fitz.open(os.path.join('Дата-сет для задачи №1/Разметка/',fname)) as doc:
        text = ""
        for page in doc:
            text += page.get_text()
    return text
text=get_first_page_from_pdf('2019-76302-19.pdf')

def get_errors_from_pdf(fname):
    tables = tabula.read_pdf(os.path.join('Дата-сет для задачи №1','Разметка/',fname), pages="all")
    flag = False

    for table in tables:
        for index, row in table.iterrows():
            if  (("среднеквадр" in str(row.iloc[0]).lower()) or ("клонен" in str(row.iloc[0]).lower())) and not flag:
                z = (float(row.iloc[1].split()[0].replace(',','.')))
                flag = True
    return z 
            
def get_device_name(f):
    stopword = '(далее'
    text = get_first_page_from_pdf(f)
    if (stopword in text):
        return(text.split(stopword)[0].split('Назначение средства измерений')[1])
        
    


def country(text): #text -весь текст pdf
    import requests
    from bs4 import BeautifulSoup
    import re
    def counrty1():
        url = 'https://ru.wikipedia.org/wiki/Список_государств'
        response = requests.get(url)
        soup = BeautifulSoup(response.text, 'lxml')
        quotes = soup.find_all('td')


        sa=[]
        for n, i in enumerate(quotes, start=1):

            a=i.text
            s=re.sub('[\n|1|2|3|4|5|6|7|8|9|0]', "", a)
            if s!='':
                sa.append(s)
        return sa

    c=counrty1()
    d='Россия'
    for i in c:
        if i in text:
            d=i

    return d

country = (country(text))
name = (get_device_name('2019-51035-12.pdf'))
error = (get_errors_from_pdf('2019-51035-12.pdf'))

d = dict()
d['name'] = name
d['country'] = country
d['error'] = error

import json

with open('new_file.json', 'w') as f:
    json.dump(d, f, indent=2)
    print("New json file is created from data.json file")


