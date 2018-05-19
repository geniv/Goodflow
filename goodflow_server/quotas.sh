#! /bin/bash
#by geniv

#with sudo!
user_quota_fce() {
  #$1 = name
  quota --hide-device -sp $1
  #quota -spw $1
}

get_user_fce() {
  #$1 = name
  quota --hide-device -p $1
}

#------------------------------------------------------------------------------#

case $1 in
  #~ "user")
    #~ user_quota_fce $2
  #~ ;;

  "getuser")
    get_user_fce $2
  ;;

  *)
    echo "invalid parameter!"
  ;;
esac
