import os
import sys

# read file txt and save to csv file

def readfileandsave(file_name):
    # open file
    file = open(file_name, 'r')
    # read file
    lines = file.readlines()
    
    for line in lines:
        # split line with space
        line = line.split()
        
        # the last element is the time
        time = line[-1]
        # before the last element is the value
        
        value = line[-2]
        
        # the rest of the line is the name
        name = ' '.join(line[:-2])
        # write to csv file
        file_csv = open(file_name + '.csv', 'a')
        file_csv.write(name + ',' + value + ',' + time + '\n')
        
    # close file
    file_csv.close()
    
if __name__ == '__main__':
    readfileandsave("/home/nguyentansy/Downloads/test.txt")