import pandas as pd
import os
import tabula
import sys
import warnings
import json
import fitz
warnings.filterwarnings("ignore")

si = ['т', 'ц', 'кг', 'г', 'мг', 'км', 'м', 'мм', 'дм', 'мк', 'ммк', 'Å', 'Х', 'га', 'А', 'м2', 'мм2', 'см2',
              'км2', 'км3', 'м3', 'см3', 'мм3', 'л', 'мл', 'ч',
              'мин', 'сек', 'мсек', 'мксек', 'ат', 'мм рт. ст.', '°С', '°R', '°F ', 'K', 'ка', 'а', 'ма', 'мка', 'кВ',
              'В', 'мВ', 'мкВ', 'моМ', 'ом',
              'ком', 'Вт', 'мВт', 'мкВт', 'кв*ч', '%', 'I', 'Гц', 'Гц', 'V', 'ГГц', 'Вт/м2', 'мкг/дм3', 'Кл', 'мА', 'ф',
              'Ф', 'мкФ', 'мкф', 'пф', 'пФ', 'гн', 'кГц', 'мГц', 'Гц']


import pandas as pd
import os
from tqdm.auto import tqdm



def system(input_file):
    import fitz
    from itertools import groupby


    def print_hightlight_text(page, rect):

        t=''
        words = page.getText("words")  # list of words on page
        words.sort(key=lambda w: (w[3], w[0]))  # ascending y, then x
        mywords = [w for w in words if fitz.Rect(w[:4]).intersects(rect)]
        group = groupby(mywords, key=lambda w: w[3])
        for y1, gwords in group:
            t+=(" ".join(w[4] for w in gwords))

        return t

    doc = fitz.open(os.path.join(input_file))
    for page in doc:
        annot = page.firstAnnot
        if annot:
            y=print_hightlight_text(page, annot.rect)
    try:
        o=0 #print(y)
    except:

         for j in si:
            text=''   #временное решение для pdf где нет разметки. Вместо text должен быть весь текст страниц
            if j in text:
                return j
            else:
                return 0

    f=y.find(',')
    lenn=len(y)-f
    ans=''
    for i in range(1,lenn):
        ans+=y[f+i].replace(':', "")
    if ans not in si:
        ans = 'null'
    return ans


 # install using: pip install PyMuPDF
def get_first_page_from_pdf(fname):
    with fitz.open(os.path.join(fname)) as doc:
        text = ""
        for page in doc:
            text += page.get_text()
    return text

def get_errors_from_pdf(fname):
    tables = tabula.read_pdf(os.path.join(fname), pages="all",silent = True)
    flag = False
    z = 0.0


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


df = pd.read_csv('Дата-сет для задачи №1/Дата-сет_Задача 1.csv',encoding = 'cp1251',sep = ';')
df_file = df[df['Наименование_файла_с_описанием']==df['Наименование_файла_с_описанием']]
s = sys.argv[1]
text=get_first_page_from_pdf(s)
country = (country(text))
name = (get_device_name(s))
error = (get_errors_from_pdf(s))
measure = (system(s))

f = open('template.json')

# returns JSON object as
# a dictionary


data = json.load(f)
(data[0]['device']['type']) = name
(data[0]['device']['country']) = country
(data[0]['device']['error']) = error
(data[0]['device']['unit']) = measure

json.dump(data, sys.stdout)