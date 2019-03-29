#!/bin/bash

# Remove munkireportinfo script
rm -f "${MUNKIPATH}preflight.d/munkireportinfo"

# Remove munkireportinfo.plist cache file
rm -f "${MUNKIPATH}preflight.d/cache/munkireportinfo.plist"
