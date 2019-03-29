#!/bin/bash

# munkireportinfo_controller
NW_CTL="${BASEURL}index.php?/module/munkireportinfo/"

# Get the script in the proper directory
"${CURL[@]}" "${NW_CTL}get_script/munkireportinfo" -o "${MUNKIPATH}preflight.d/munkireportinfo"

if [ "${?}" != 0 ]
then
	echo "Failed to download all required components!"
	rm -f ${MUNKIPATH}preflight.d/munkireportinfo
	exit 1
fi

# Make executable
chmod a+x "${MUNKIPATH}preflight.d/munkireportinfo"

# Set preference to include this file in the preflight check
setreportpref "munkireportinfo" "${CACHEPATH}munkireportinfo.plist"