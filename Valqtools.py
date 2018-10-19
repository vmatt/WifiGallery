
###############################################
# Developer: Mate Valko                       #
# Mail: mate.valko@ge.com / ge@valq.hu        #
# Site: valQ.hu                               #
#### If you have any questions, contact me ####

import sys
import time
import datetime
import csv
csv.field_size_limit(122337204)

class Qtimer:
    def __init__(self,modIteration, *args, **kwargs):
        self.master = kwargs.get('master')
        self.modIteration=modIteration
        self.lineCount=0
        self.modItCount=0
        self.start=time.time()
        self.end = 0

    def lap (self,*args, **kwargs):
        self.showAvg = kwargs.get('showAvg')        
        self.lineCount+=1
        if self.lineCount % self.modIteration == 0:
            self.startlap = time.time()
            self.laptime = time.time()-self.startlap
            self.end    = time.time()-self.start            
            self.modItCount+=1
            if self.master:
                self.indent=""
            else:
                self.indent="\t"
            if args:
                print("%sDesc: %s" % (self.indent, args[0]))
            
                print("%sLap %s:\t%s seconds" % (self.indent, self.lineCount,self.end))
                print("%sCurrent time: %s" % (self.indent,datetime.datetime.now()))
                #print("%sLaptime:%s" % (self.indent, self.end))
                print("\r\n")
            if self.showAvg:
                self.avg=self.end/self.modItCount
                print("%sAvg Time\t%s seconds" % (self.indent, self.avg))

class valQtools:       
    def uprint(self, *objects, sep=' ', end='\n', file=sys.stdout):
        enc = file.encoding
        if enc == 'UTF-8':
            print(*objects, sep=sep, end=end, file=file)
        else:
            f = lambda obj: str(obj).encode(enc, errors='backslashreplace').decode(enc)
            print(*map(f, objects), sep=sep, end=end, file=file)         
