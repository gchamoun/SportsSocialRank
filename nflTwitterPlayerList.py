#!/usr/bin/python
# -*- coding: utf-8 -*-
import time
import tweepy
import csv
import os
import mysql.connector
import datetime
import pytz
from dateutil import tz


mydb = mysql.connector.connect(
  host="sportssocialrank.db.10366090.db2.hostedresource.net",
  user="sportssocialrank",
  passwd="LLRo1984!123",
  database="sportssocialrank"
)
mycursor = mydb.cursor()

#twitter application credentials
consumer_key="6wR5l7KwDSDFmb6swY1seW5MP"
consumer_secret="RTg9GlOPcX0YCCkodKzMzUw7z1iOdVy5fwJlD5JxbqW33XKNmL"

#twitter user credentials
access_token="562520337-IWHslct3vqnZq9DPLHKKF7xlYrQrf5Nolatbm52T"
access_token_secret="BmbHCJgoTTlhX99PjgRiN6uWqle6xJCepHvFDtNSfEHLy"
playerList = list();

auth = tweepy.OAuthHandler(consumer_key, consumer_secret)
auth.set_access_token(access_token, access_token_secret)
api = tweepy.API(auth)

# which Twitter list and who owns it
slug = 'bundesliga-teams'
owner = 'Bundesliga_EN'


def get_list_members(api, owner, slug):
	members = []
	# without this you only get the first 20 list members
	for page in tweepy.Cursor(api.list_members, owner, slug).items():
		members.append(page)
	# create a list containing all usernames
	return [ m.screen_name for m in members ]

def get_userinfo(name,time):
	# get all user data via a Tweepy API call
	user = api.get_user(screen_name = name)
	# create row data as a list
	user_info =  '"' +time + '"' + "," + '"' + name +'"' + "," + '"' + user.name + '"' + "," +'"'+str(user.followers_count) +'"' + "," + '"' +str(user.friends_count) +'"'+ "," + '"' +user.profile_image_url +'"'
	timeString =  time
	nameString =  name
	usernameString =  user.name
	category = "Bundesliga"
	followersString = str(user.followers_count)
	followingString =  str(user.friends_count)
	profileImageString = user.profile_image_url
	try:
		mycursor = mydb.cursor()
		try:
			mycursor.execute("INSERT INTO users (Name, Category, Twitter_username, Instagram_username) VALUES (%s, %s, %s, %s)", ( usernameString, category, nameString,nameString))
		except psycopg2.IntegrityError:
			conn.rollback()
		else:
			mydb.commit()
	except Exception as e:
		print ("'ERROR:', e[0]")
	print(mycursor.rowcount, "record inserted.")
	print(user_info)
	# send that one row back
	return user_info

def get_currenttime():
	ts = time.time()
	st = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')
	return st
	# Convert from UTC to tz's local time.
def update_db(usernames):
	time = get_currenttime()
	# add each member to the csv
	for name in usernames:
		get_userinfo(name,time)

def main():
	# create list of all members of the Twitter list
	usernames = get_list_members(api, owner, slug)
	update_db(usernames)
	# # provide name for new CSV
	# filename = "nflteamtwitter.csv"
	# # create new CSV and fill it
	# create_csv(filename, usernames)
	# # tell us how many we got
	# print ("Number of rows should be %d, plus the header row." % len(usernames))

if __name__ == '__main__':
	main()
