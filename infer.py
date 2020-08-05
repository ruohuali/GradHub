import numpy as np
from sklearn import tree
from sklearn.cluster import KMeans
import pdb

table = {"UIUC": 4, "Umich": 4, "MIT": 5, "Princeton": 5, "Purdue": 3, "UCSD": 4, "UCLA": 4, "UCB": 5, "Caltech": 5, "EMU": 2, "HACC": 1, "PKU": 4, "THU": 4 }

def train(X,Y):
	clf = trainTree(X,Y)
	kmeans = trainKM(X)
	return clf,kmeans

def trainTree (X,Y): 
	clf = tree.DecisionTreeClassifier()
	clf = clf.fit(X, Y)
	return clf
#def preprocess (target):


def trainKM(X):
	kmeans = KMeans(n_clusters=3, random_state=0).fit(X)
	return kmeans	

def infer ((tree,kmeans), x, X, Y):
	tresult = tree.predict(x)
	xcluster = kmeans.predict(x)
	kcluster = kmeans.fit_predict(X)
	schoolranks = [Y[index] for index in range(len(kcluster)) if kcluster[index] == xcluster]
	kresult = sum(schoolranks) // len(schoolranks)
	#print("k", kresult)
	#print("tre", tresult)
	return min(tresult[0], kresult), max(tresult[0], kresult)

def name2vec(uni_names):
	return [table[x] for x in uni_names]

if __name__ == "__main__":
	uni_names = []
	X = []
	with open("samples.txt","r+") as file:
		for line in file.readlines():
			l = line.rsplit()
			school_vec = name2vec([l[2]])
			uni_names.append(l[-1])
			x = [float(i) for idx, i in enumerate(l) if idx in [0,1,3,4,5]]
			x.extend(school_vec)
			X.append(x)

	Y = name2vec(uni_names)	
	X, Y = np.array(X), np.array(Y)
	print(X.shape, Y.shape)
	clf, kmeans = train(X,Y)

	Z = []
	with open("input.txt","r") as file:
                for line in file.readlines():
                        l = line.rstrip().rsplit(", ")
			#print("l", l)
                        school_vec = name2vec([l[2]])
                        z = [float(i) for idx, i in enumerate(l) if idx in [0,1,3,4,5]]
                        z.extend(school_vec)
                        Z.append(z)	


	result = infer((clf,kmeans), Z, X, Y)
	schoolnames = [k for k, val in table.items() if val >= result[0] and val <= result[1]]
	print(schoolnames)
	with open("result.txt","r+") as file:
		file.truncate(0)
		file.write(str(schoolnames))
		
        with open("input.txt","r+") as file:
                file.truncate(0)
	with open("samples.txt","r+") as file:
                file.truncate(0)




 
