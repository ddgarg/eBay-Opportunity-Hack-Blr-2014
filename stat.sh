basedir=~/eBay-Opportunity-Hack-Blr-2014
for dir in creating-futures diya evidyaloka i-us-we ivolunteer mitan need-base Nirmaan nisvartha oorvani parishodh/arthika parishodh/inventory-management parishodh/rachana range-de say-trees/CarbonFootPrint say-trees/tree-finder say-trees/volunteer sevai-karangal sumuka vazhai vidyaranya
#for dir in i-us-we ivolunteer 
do
 #echo "======$dir======"
 cd $basedir/$dir
 filecount=`find . -type f |grep -v "\/\." | wc -l`
 echo $dir":"$filecount
 #echo "Total file count : " $filecount
 #find . -type f -name '?*.*' | grep -v "\/\." | sed 's/.*\.//' | sort | uniq -c | sort -rn
done

#sh stat.sh  | sort --field-separator=: -k 2 -nr
