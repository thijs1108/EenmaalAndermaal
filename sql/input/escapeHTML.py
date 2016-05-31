import re
import argparse
parser = argparse.ArgumentParser()
parser.add_argument("input", help="sourcebestand voor HTML tags escaping")
args = parser.parse_args()
with open(args.input, 'r') as myfile:
    data=re.sub(myfile.read(),'/<.*?>/g', '')
    print(data)
