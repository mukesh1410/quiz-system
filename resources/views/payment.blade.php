<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Page</title>
</head>
<body>
    <h2>Processing...</h2>
 <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
document.getElementById("payButton").onclick = function (e) {
    e.preventDefault();

    var options = {
        "key": "{{ env('RAZORPAY_KEY') }}",
        "amount": 100, // ₹1.00 in paise
        "currency": "INR",
        "name": "Your Site",
        "description": "Blog Access",
        "order_id": "{{ $orderId }}",
        "handler": function (response) {
            fetch("/pay/callback", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    razorpay_order_id: response.razorpay_order_id,
                    razorpay_payment_id: response.razorpay_payment_id,
                    razorpay_signature: response.razorpay_signature
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const blogBtn = document.getElementById("blogButton");
                    blogBtn.classList.remove("opacity-50", "pointer-events-none");
                    blogBtn.classList.add("bg-green-600", "text-white");
                    alert("✅ Payment successful! Blog button unlocked.");
                } else {
                    alert("❌ Payment verification failed.");
                }
            });
        }
    };

    var rzp = new Razorpay(options);
    rzp.open();
};
</script>


</body>
</html>