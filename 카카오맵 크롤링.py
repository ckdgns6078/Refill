from email.headerregistry import Address
from itertools import count
from modulefinder import STORE_NAME
from tkinter import ANCHOR
from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import time
import requests
import csv
import re
from soupsieve import select

# 브라우저 생성 및  크롬 드라이버 다운로드 후 경로 지정
options = webdriver.ChromeOptions()
options.add_experimental_option("excludeSwitches", ["enable-logging"])
driver = webdriver.Chrome('C:\chromedriver.exe',options=options)
driver.implicitly_wait(3) # 3초까지 기다리기

filename =('crawling')
list=[]

driver.get('https://map.kakao.com/') # 웹 사이트 열기
time.sleep(5) # 5초 지연주기 (로딩시간동안 아래 코드 진행되는거 방지)

element = driver.find_element_by_xpath('//*[@id="search.keyword.query"]')#검색창 찾기
element.send_keys("리필스테이션")#리필스테이션 검색
element.send_keys(Keys.ENTER)
time.sleep(2)

driver.find_element_by_xpath('//*[@id="info.main.options"]/li[2]/a').send_keys(Keys.ENTER)#장소 클릭



def storeNamePrint():
    
    time.sleep(0.2)    
    
    html = driver.page_source
    soup = BeautifulSoup(html, 'html.parser')
    
    #전부 가져오기 (select는 전부 가져온다.)
    store_lists = soup.select('ul.placelist > li.PlaceItem.clickArea')
    count = 1

    
    for store in store_lists :
    
        temp=[]
        
        store_name = store.select('.head_item > .tit_name > .link_name')[0].text
        store_score = store.select('.rating > .score > .num')[0].text 
        review = store.select('.rating > .review')[0].text
        link = store.select('.contact > .moreview')[0]['href']
        addr = store.select('.addr')[0].text
   
        #리뷰 문자 제거 & 숫자만 반환
        review = review[3:len(review)]   
        
        #review = int(re.sub(",",",review"))
        
        print(store_name,store_score , review , link , addr)
        
        temp.append(store_name)
        temp.append(store_score)
        temp.append(review)
        temp.append(link)
        temp.append(addr)
        
        list.append(temp)

        f=open(filename+'.csv', 'w', newline='')
        csvwriter=csv.writer(f)
        header = ['Name','Score','Review','Link','Addr']
        csvwriter.writerow(header)
    
        for i in list:
            csvwriter.writerows(list)

storeNamePrint()

page = 1
page2= 0

for i in range(0,6):
    
    try:
        page2+=1
        print("***",page,"***")
        
        element.find_element_by_xpath(f'//*[@id="info.search.page.no{page2}"]').send_keys(Keys.ENTER)
        storeNamePrint()
        
        if(page2)%5==0:
                element.find_element_by_xpath(f'//*[@id="info.search.page.next"]').send_keys(Keys.ENTER)
                page2=0
                
        page+=1
    except:
            break
print("크롤링 완료")
    