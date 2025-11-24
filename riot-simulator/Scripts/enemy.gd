extends RigidBody2D


# Called when the node enters the scene tree for the first time.
func _ready() -> void:
	get_node("AnimatedSprite2D").play()


# Called every frame. 'delta' is the elapsed time since the previous frame.
func _process(delta: float) -> void:
	get_node("AnimatedSprite2D").flip_h = linear_velocity.x >= 0


func _on_visible_on_screen_notifier_2d_screen_exited() -> void:
	queue_free() # Delete instance at the end of the frame
