import urllib.request
from urllib.request import urlretrieve
import time
import re
from os import listdir
from os.path import isfile, join
from socket import *
from valqtools import Qtimer

def getRemoteFileList( path ):
	response = urllib.request.urlopen("http://192.168.8.2/command.cgi?op=100&DIR="+path,timeout=5).read()
	output = response.decode('utf-8')
	return output
def getLocalFileList( path ):
	onlyfiles = [f for f in listdir(path) if isfile(join(path, f))]
	return onlyfiles
def photoList( string ):
	return re.findall('([^\,]+\.(?:JPG))', output, re.DOTALL)
def compareFolders(list1, list2):
    c = set(list1).union(set(list2))
    d = set(list1).intersection(set(list2))
    return list(c - d)
def downloadFiles(localPath,remotePath,diff):
	index = 0
	if not diff:
		print ("Nincs új fájl")
	elif (isinstance(diff, list)):
		for item in diff:   
			print("Fájl letöltése: "+item)
			index += 1
			fullfilename = join(localPath, item)
			urlretrieve("http://192.168.8.2"+remotePath+"/"+item, fullfilename)
		print("Fájlok letöltése kész")

	
remotePath="/DCIM/100__TSB"
localPath="./img/"
while True:
	try:
		timer = Qtimer (1)
		timer.lap("Starting")
		localFiles=getLocalFileList(localPath)
		output = getRemoteFileList(remotePath)
		sdFiles = photoList(output)
		timer.lap("Read remote files")
		diff=compareFolders(localFiles,sdFiles)
		downloadFiles(localPath,remotePath,diff)
		time.sleep(5)		
	except urllib.error.URLError:
		print ("Wifi card not available")
	except timeout:
		print ("Timeout")
		
