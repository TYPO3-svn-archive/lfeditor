function submitBackupForm(filename, langFile, del, restore, deleteAll, origDiff) {
	document.mainForm.elements['delete'].value = del;
	document.mainForm.elements['restore'].value = restore;
	document.mainForm.elements['deleteAll'].value = deleteAll;
	document.mainForm.elements['origDiff'].value = origDiff;
	document.mainForm.elements['file'].value = filename;
	document.mainForm.elements['langFile'].value = langFile;
	document.mainForm.submit();
}

function submitRedirectForm(label, value, token) {
	document.mainForm.elements[label].value = value + token;
	document.mainForm.submit();
}

function submitSessionLangFileEdit(buttonType, session) {
	if (session == 'undefined') {
		session = 1;
	}

	document.mainForm.elements['session'].value = session;
	document.mainForm.elements['buttonType'].value = buttonType;
}

function metaTypeCheck() {
	if (document.mainForm.elements['metaType'].value == 'CSH') {
		document.mainForm.elements['metaCSHTable'].disabled = 0;
		document.mainForm.elements['metaCSHTable'].focus();
	} else {
		document.mainForm.elements['metaCSHTable'].disabled = 1;
		document.mainForm.elements['metaCSHTable'].value = '';
	}
}

/** args -- fieldID(id), picID(id), bottom(boolean) */
function openCloseTreeEntry(prefix, args) {
	var length = arguments.length;
	var pic, curTreeHide;

	for (var i = 1; i < length; i += 3) {
		curTreeHide = 0;
		if (!document.getElementById(arguments[i]).style.display) {
			curTreeHide = 1;
		}

		if (curTreeHide) {
			document.getElementById(arguments[i]).style.display = 'none';
			pic = 'Plus';
		} else {
			document.getElementById(arguments[i]).style.display = '';
			pic = 'Minus';
		}

		if (arguments[i + 2]) {
			pic = pic + 'Bottom';
		}

		document.getElementById(arguments[i + 1]).src = prefix + 'res/images/tree' + pic + '.gif';
		document.getElementById(arguments[i + 1]).alt = 'tree' + pic;
	}
}
