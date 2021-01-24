import React, { useEffect, useState } from "react"
import { QRCode } from "react-qrcode-logo"

function App() {
	const [secretKey, setSecretKey] = useState<string>()

	useEffect(() => {
		// setSecretKey(getSecretKey())
	}, [])

	const getSecretKey = async () => {
		await fetch("http://localhost:8000/generate-code", {
			method: "get",
			mode: "cors",
			headers: {
				"Content-Type": "application/json",
			},
		})
			.then((res) => res.json())
			.then((data) => {
				console.log(data)
			})
	}

	return (
		<div
			style={{
				height: "100vh",
				width: "100vh",
				display: "flex",
				justifyContent: "center",
				verticalAlign: "center",
				alignItems: "center",
				textAlign: "center",
			}}
		>
			<QRCode value="otpauth://totp/PasuSewa:contact@pasusewa.com?secret=DCRMALCXPEZOFKZH&issuer=PasuSewa&algorithm=SHA1&digits=6&period=30" />
		</div>
	)
}

export default App
